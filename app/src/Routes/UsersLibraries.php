<?php declare(strict_types=1);

use Cineboard\Model\User;
use Cineboard\Model\Library;
use Slim\Http\Request;
use Slim\Http\Response;

/** @var \Slim\App $app */
global $app;

$app->get('/users/{id:[0-9]+}/libraries', function (Request $request, Response $response, array $args) {
    unset($request);
    $user = User::with('libraries')->find($args["id"]);
    if (!$user) {
        $data = "user not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($user, 200);
});
