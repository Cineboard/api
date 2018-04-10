<?php declare(strict_types=1);

use Cineboard\Model\Category;
use \Slim\Http\Request;
use \Slim\Http\Response;

/** @var \Slim\App $app */
global $app;

$app->get('/categories', function (Request $request, Response $response, array $args) {
    unset($request);
    unset($args);

    $categories = Category::all();
    if (!$categories) {
        $data = "categories not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($categories, 200);
});

$app->get('/categories/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);

    $category = Category::find($args["id"]);
    if (!$category) {
        $data = "category not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($category, 200);
});

$app->post('/categories', function (Request $request, Response $response, array $args) use ($app) {
    unset($args);

    $parsedBody = $request->getParsedBody();

    // match number of db field
    if (count($parsedBody) > 1) {
        $data = "too much argumets";
        return $response->withJson($data, 401);
    }

    $name = $parsedBody['name'];
    if (!isset($name)) {
        $data = "name cannot be null";
        return $response->withJson($data, 401);
    }

    // name db varchar 255 - if not 404 to avoid useless db interrogation
    if (mb_strlen($name, 'UTF-8') > 255) {
        $data = "name too long: max 255 chars";
        return $response->withJson($data, 401);
    }

    // name is unique - check it
    $category = Category::where('name', $name)->first();
    // check instanceof instead of obj
    if ($category instanceof Category && $category->name == $name) {
        $data = "name already exists";
        return $response->withJson($data, 401);
    }
    // create if not exists
    $category = new Category();
    $category->name = $name;
    $category->save();
    $app->getContainer()->get('logger')->info("NEW CATEGORY CREATED " . var_export($category['name'], true));

    return $response->withJson($category, 200);
});

$app->put('/categories/{id:[0-9]+}', function (Request $request, Response $response, array $args) use ($app) {
    $parsedBody = $request->getParsedBody();

    // match number of db field
    if (count($parsedBody) > 1) {
        $data = "too much argumets";
        return $response->withJson($data, 401);
    }

    $name = $parsedBody['name'];

    if (!isset($name)) {
        $data = "name cannot be null";
        return $response->withJson($data, 401);
    }

    // category name db varchar 255 - if not 404 to avoid useless db interrogation
    if (mb_strlen($name, 'UTF-8') > 255) {
        $data = "name too long: max 255 chars";
        return $response->withJson($data, 401);
    }

    // name is unique - check it
    $category = Category::find($args['id']);
    // check instanceof instead of obj
    if ($category instanceof Category && $category->name == $name) {
        $data = "category name already exists";
        return $response->withJson($data, 401);
    }

    $category->name = $name;
    $category->save();
    $app->getContainer()->get('logger')->info("CATEGORY EDITED " . var_export($category['name'], true));

    return $response->withJson($category, 200);
});

// delete existing record
$app->delete('/categories/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);

    $category = Category::find($args["id"]);
    if (!$category instanceof Category) {
        $data = "category not found";
        return $response->withJson($data, 404);
    }

    $category->delete();
    return $response->withJson($category, 200);
});
