<?php

use Cineboard\Helper\CorsOptions;

// inject CORS on routes
$app->options('/{routes:.+}', function ($request, $response, $args) {
    unset($request);
    unset($args);
    return $response;
});

// inject CORS on $response
$app->add(function ($request, $response, $next) {
    $response = $next($request, $response);
    $response = addCorsHeaders($response);
    return $response;
});
