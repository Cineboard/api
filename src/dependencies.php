<?php

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

// DIC configuration
$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

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

// initializate logger
$logger = $app->getContainer()->logger;