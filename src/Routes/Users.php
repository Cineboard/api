<?php declare(strict_types=1);

use Cineboard\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

global $app;

// Routes

// read all records
$app->get('/users', function (Request $request, Response $response, array $args) {
    $data = User::all();
    $resp["status"] = "OK";
    $resp["data"] = $data;
    return $response->withJson($resp);
});

// return single record
$app->get('/users/{id}', function (Request $request, Response $response, $args) {
    unset($request);
    $data = User::find($args["id"]);
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    return $response->withJson($resp);
});

// save/create data for a new record
$app->post('/users', function (Request $request, Response $response, $args) {
    $name = $request->getParam("name");
    $data = new User();
    $data->name = $name;
    $data->save();
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    return $response->withJson($resp);
});

// save/update for existing record
$app->put('/users/{id}', function (Request $request, Response $response, $args) {
    $name = $request->getParam("name");
    $data = User::find($args["id"]);
    if ($data) {
        $data->name = $name;
        $data->save();
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    return $response->withJson($resp);
});

// delete existing record
$app->delete('/users/{id}', function (Request $request, Response $response, $args) {
    $data = User::find($args["id"]);
    $data->delete();
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    return $response->withJson($resp);
});
