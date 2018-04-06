<?php declare(strict_types=1);

use Cineboard\Model\Category;
use \Slim\Http\Request;
use \Slim\Http\Response;

global $app;

// read all records
$app->get('/categories', function (Request $request, Response $response, $args) {
    $data = Category::all();

    // build response
    $resp["status"] = "OK";
    $resp["data"] = $data;

    // Returning response
    return $response->withJson($resp);
});

// return single record
$app->get('/categories/{id}', function (Request $request, Response $response, $args) {
    $data = Category::find($args["id"]);
    // build response
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    // Returning response
    return $response->withJson($resp);
});

// save/create data for a new record
$app->post('/categories', function (Request $request, Response $response, $args) {
    $name = $request->getParam("name");
    $data = new Category();
    $data->name = $name;
    $data->save();
    // build response
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    // Returning response
    $response = $response->withJson($resp);
});

// save/update for existing record
$app->put('/categories/{id}', function (Request $request, Response $response, $args) {
    $name = $request->getParam("name");
    $data = Category::find($args["id"]);
    $data->name = $name;
    $data->save();
    // build response
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    // Returning response
    return $response->withJson($resp);
});

// delete existing record
$app->delete('/categories/{id}', function (Request $request, Response $response, $args) {
    $data = Category::find($args["id"]);
    $data->delete();
    // build response
    if ($data) {
        $resp["status"] = "OK";
    } else {
        $resp["status"] = "ERR";
    }
    $resp["data"] = $data;
    // Returning response
    return $response->withJson($resp);
});
