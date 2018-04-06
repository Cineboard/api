<?php declare(strict_types=1);

use Cineboard\Model\Library;
use \Slim\Http\Request;
use \Slim\Http\Response;

global $app;

// read all records
$app->get('/libraries', function (Request $request, Response $response, $args) {
    $data = Library::all();
    // build response
    $resp["status"] = "OK";
    $resp["data"] = $data;
    // Returning response
    return $response->withJson($resp);
});

// return single record
$app->get('/libraries/{id}', function (Request $request, Response $response, $args) {
    unset($request);

    $data = Library::find($args["id"]);
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
$app->post('/libraries', function (Request $request, Response $response, $args) {
    unset($args);

    $name = $request->getParam("name");
    $data = new Library();
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

// save/update for existing record
$app->put('/libraries/{id}', function (Request $request, Response $response, $args) {
    $name = $request->getParam("name");
    $data = Library::find($args["id"]);
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
$app->delete('/libraries/{id}', function (Request $request, Response $response, $args) {
    unset($request);

    $data = Library::find($args["id"]);
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
