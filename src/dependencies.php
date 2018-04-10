<?php declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Slim\Container;
use Slim\Http\Response;
use Slim\Http\Request;
use Cineboard\Helper\DbConnExceptionHandler;

global $app;

// Container Injection
$container = $app->getContainer();

// Monolog Logger
$container['logger'] = function (Container $container) {
    $settings = $container->get('settings');
    $logger = new Logger($settings['logger']['name']);
    $logger->pushProcessor(new UidProcessor());
    $logger->pushHandler(
        new StreamHandler(
            $settings['logger']['path'],
            $settings['logger']['level']
        )
    );
    return $logger;
};


// Eloquent ORM
$capsule = new Capsule;
$capsule->addConnection($container->get('settings')['database']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
    ExceptionHandler::class,
    DbConnExceptionHandler::class
);

// http-cache and etags
$container['cache'] = function (Container $container) {
    return new \Slim\HttpCache\CacheProvider();
};

// Error Handler - needed by frontend
$container['errorHandler'] = function (Container $container) {
    return function ($request, $response, $exception) use ($container) {
        unset($request);

        $settings = $container->settings;

        $errorCode = 500;
        if (is_numeric($exception->getCode())
            && $exception->getCode() > 300
            && $exception->getCode() < 600) {
            $errorCode = $exception->getCode();
        }

        $data = [
            'error_code' => $errorCode,
            'error_message' => $exception->getMessage()
        ];

        if ($settings['debug'] == true) {
            $data['file'] = $exception->getFile();
            $data['line'] = $exception->getLine();
            $data['trace'] = explode("\n", $exception->getTraceAsString());
        }

        $container->logger->error($errorCode
            . " ON " . $exception->getFile()
            .  ":" . $exception->getLine()
            . " - " . $exception->getMessage());

        return $response->withStatus(500)
                        ->withJson(['error' => 'Aplication error', 'error_details' => $data]);
    };
};
