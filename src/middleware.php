<?php declare(strict_types=1);

global $app;

// inject OPTIONS on routes - needed by frontend
$app->options('/{routes:.+}', function ($request, $response, $args) {
    unset($request);
    unset($args);
    return $response;
});

// inject CORS on routes
$app->add(function ($request, $response, $next) {
    global $app;
    $corsDomain = $app->getContainer()->get("settings")["security"]["cors_domain"];

    $response = $next($request, $response);
    return $response
            ->withHeader('Access-Control-Allow-Origin', $corsDomain)
            ->withHeader(
                'Access-Control-Allow-Headers',
                'X-Requested-With, Content-Type, Accept, Origin, Authorization'
            )
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
