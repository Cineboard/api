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
    /**
     * Parse request body
     */
    $parsedBody = $request->getParsedBody();

    /**
     * Start body fields check
     */

    if (!isset($parsedBody['name'])) {
        $data = "name cannot be null";
        return $response->withJson($data, 400);
    } else {
        if (mb_strlen($parsedBody['name'], 'UTF-8') > 255) {
            $data = "name too long: max 255 chars";
            return $response->withJson($data, 400);
        }
    }

    /**
     * Check existence for element to create: name is UNIQUE
     */
    $category = Category::where('name', $parsedBody['name'])->first();
    // check instanceof instead of obj
    if ($category instanceof Category && $category->name == $parsedBody['name']) {
        $data = "name already exists";
        return $response->withJson($data, 400);
    }
    $name = $parsedBody['name'];
    // create if not exists
    $category = new Category();
    $category->name = $name;
    $category->save();
    $app->getContainer()->get('logger')->info("NEW CATEGORY CREATED " . var_export($category['name'], true));

    return $response->withJson($category, 200);
});

$app->put('/categories/{id:[0-9]+}', function (Request $request, Response $response, array $args) use ($app) {
    /**
     * Parse request body
     */
    $parsedBody = $request->getParsedBody();

    $app->getContainer()->get('logger')->debug("PUT categories, body: " . var_export($parsedBody, true));

    /**
     * Check existence for element to update
     */
    $category = Category::find($args['id']);
    // check instanceof instead of obj
    if (!$category instanceof Category) {
        $data = "category to update not found";
        return $response->withJson($data, 404);
    }

    /**
     * Start body fields check
     */

    // category name db varchar 255 - if not 404 to avoid useless db interrogation
    if (isset($parsedBody['name'])) {
        if (mb_strlen($parsedBody['name'], 'UTF-8') > 255) {
            $data = "name too long: max 255 chars";
            return $response->withJson($data, 401);
        }

        $category->name = $parsedBody['name'];
    }

    if (array_key_exists('deleted_at', $parsedBody)) {
        if (is_integer($parsedBody['deleted_at'])) {
            /**
             * If submitted date is a timestamp, convert it to db date format
             */
            $parsedBody['deleted_at'] = date('Y-m-d H:i:s');
        }

        $category->deleted_at = $parsedBody['deleted_at'];
    }

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
