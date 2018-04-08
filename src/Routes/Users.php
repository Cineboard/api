<?php declare(strict_types=1);

use Cineboard\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

/** @var \Slim\App $app */
global $app;

$app->get('/users', function (Request $request, Response $response, array $args) {
    unset($request);
    $users = User::all();
    if (!$users) {
        $data = "users not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($users, 200);
});

// return single record
$app->get('/users/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);
    $user = User::find($args["id"]);
    if (!$user) {
        $data = "user not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($user, 200);
});

$app->post('/users', function (Request $request, Response $response, array $args) use ($app) {
    $parsedBody = $request->getParsedBody();

    // match number of db field
    if (count($parsedBody) > 1) {
        $data = "too much argumets";
        return $response->withJson($data, 401);
    }

    $name = $parsedBody['name'];

    $app->getContainer()
        ->get('logger')
        ->debug('Route /users has been called with args ' . var_export($args, true));


    if (!isset($name)) {
        $data = "name cannot be null";
        return $response->withJson($data, 401);
    }

    // name db varchar 30 - if not 404 to avoid useless db interrogation
    if (mb_strlen($name, 'UTF-8') > 30) {
        $data = "name too long: max 30 chars";
        return $response->withJson($data, 401);
    }

    // name is unique - check it
    $user = User::where('name', $name)->first();
    // check instanceof instead of obj
    if ($user instanceof User && $user->name == $name) {
        $data = "name already exists";
        return $response->withJson($data, 401);
    }
    // create if not exists
    $user = new User();
    $user->name = $name;
    $user->save();
    $app->getContainer()
        ->get('logger')
        ->info("NEW USER CREATED " . var_export($user['name'], true));

    return $response->withJson($user, 200);
});

$app->put('/users/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $parsedBody = $request->getParsedBody();
    if (count($parsedBody) > 1) {
        $data = "too much argumets";
        return $response->withJson($data, 401);
    }

    $name = $parsedBody['name'];

    if (!isset($name)) {
        $data = "name cannot be null";
        return $response->withJson($data, 401);
    }

    if (mb_strlen($name, 'UTF-8') > 30) {
        $data = "name too long: max 30 chars";
        return $response->withJson($data, 401);
    }

    $user = User::find($args["id"]);
    if (!$user instanceof User) {
        $data = "user not found";
        return $response->withJson($data, 404);
    }

    $user->name = $name;
    $user->save();
    return $response->withJson($user, 200);
});

// delete existing record
$app->delete('/users/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);

    $user = User::find($args["id"]);
    if (!$user instanceof User) {
        $data = "user not found";
        return $response->withJson($data, 404);
    }

    $user->delete();
    return $response->withJson($user, 200);
});
