<?php declare(strict_types=1);

use Cineboard\Model\Library;
use \Slim\Http\Request;
use \Slim\Http\Response;

/** @var \Slim\App $app */
global $app;

$app->get('/libraries', function (Request $request, Response $response, array $args) {
    unset($request);
    unset($args);

    $libraries = Library::with('categories')->get();
    if (!$libraries) {
        $data = "libraries not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($libraries, 200);
});

$app->get('/libraries/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);
    $library = Library::with('categories')->find($args["id"]);
    if (!$library) {
        $data = "library not found";
        return $response->withJson($data, 404);
    }
    return $response->withJson($library, 200);
});

$app->post('/libraries', function (Request $request, Response $response, array $args) {
    unset($args);
    $parsedBody = $request->getParsedBody();

    // match number of db field
    if (count($parsedBody) > 8) {
        $data = "too many argumets";
        return $response->withJson($data, 401);
    }

    $userId = $parsedBody['user_id'];
    $title = $parsedBody['title'];
    $director = $parsedBody['director'];
    $rating = $parsedBody['rating'];
    $viewed = $parsedBody['viewed'];
    $url = $parsedBody['url'];
    $tags = $parsedBody['tags'];
    $notes = $parsedBody['notes'];

    // check db fields limits and null/not null

    if (!isset($userId)) {
        $data = "user_id cannot be null";
        return $response->withJson($data, 401);
    }

    if (!isset($title)) {
        $data = "title cannot be null";
        return $response->withJson($data, 401);
    }

    // library title db varchar 200
    if (mb_strlen($title, 'UTF-8') > 200) {
        $data = "title too long: max 200 chars";
        return $response->withJson($data, 401);
    }

    // library director db varchar 50
    if (isset($director)) {
        if (mb_strlen($director, 'UTF-8') > 50) {
            $data = "director too long: max 50 chars";
            return $response->withJson($data, 401);
        }
    }

    // library url db varchar 300
    if (isset($url)) {
        if (mb_strlen($url, 'UTF-8') > 300) {
            $data = "url too long: max 300 chars";
            return $response->withJson($data, 401);
        }
    }

    // library tags db text - application limit
    if (isset($tags)) {
        if (mb_strlen($tags, 'UTF-8') > 500) {
            $data = "tags too long: max 500 chars";
            return $response->withJson($data, 401);
        }
    }

    // library notes db text - application limit
    if (isset($notes)) {
        if (mb_strlen($notes, 'UTF-8') > 500) {
            $data = "notes too long: max 500 chars";
            return $response->withJson($data, 401);
        }
    }

    // create if not exists
    $library = new Library();
    $library->user_id = $userId;
    $library->title = $title;
    $library->director = $director;
    $library->rating = $rating;
    $library->viewed = $viewed;
    $library->url = $url;
    $library->tags = $tags;
    $library->notes = $notes;
    $library->save();
    //$this->logger->info("NEW LIBRARY CREATED " . var_export($library['title'], true));

    return $response->withJson($library, 200);
});

// save/update for existing record
$app->put('/libraries/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $parsedBody = $request->getParsedBody();

    // match number of db field
    if (count($parsedBody) > 8) {
        $data = "too much argumets";
        return $response->withJson($data, 401);
    }

    $userId = $parsedBody['user_id'];
    $title = $parsedBody['title'];
    $director = $parsedBody['director'];
    $rating = $parsedBody['rating'];
    $viewed = $parsedBody['viewed'];
    $url = $parsedBody['url'];
    $tags = $parsedBody['tags'];
    $notes = $parsedBody['notes'];

    // check db fields limits and null/not null

    if (!isset($userId)) {
        $data = "user_id cannot be null";
        return $response->withJson($data, 401);
    }

    if (!isset($title)) {
        $data = "title cannot be null";
        return $response->withJson($data, 401);
    }

    // library title db varchar 200
    if (mb_strlen($title, 'UTF-8') > 200) {
        $data = "title too long: max 200 chars";
        return $response->withJson($data, 401);
    }

    // library director db varchar 50
    if (isset($director)) {
        if (mb_strlen($director, 'UTF-8') > 50) {
            $data = "director too long: max 50 chars";
            return $response->withJson($data, 401);
        }
    }

    // library url db varchar 300
    if (isset($url)) {
        if (mb_strlen($url, 'UTF-8') > 300) {
            $data = "url too long: max 300 chars";
            return $response->withJson($data, 401);
        }
    }

    // library tags db text
    if (isset($tags)) {
        if (mb_strlen($tags, 'UTF-8') > 500) {
            $data = "tags too long: max 500 chars";
            return $response->withJson($data, 401);
        }
    }

    // library notes db text
    if (isset($notes)) {
        if (mb_strlen($notes, 'UTF-8') > 500) {
            $data = "notes too long: max 500 chars";
            return $response->withJson($data, 401);
        }
    }

    $library = Library::find($args["id"]);
    if (!$library instanceof Library) {
        $data = "library not found";
        return $response->withJson($data, 401);
    }
    $library->user_id = $userId;
    $library->title = $title;
    $library->director = $director;
    $library->rating = $rating;
    $library->viewed = $viewed;
    $library->url = $url;
    $library->tags = $tags;
    $library->notes = $notes;
    $library->save();

    return $response->withJson($library, 200);
});

// delete existing record
$app->delete('/libraries/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    unset($request);

    $library = Library::find($args["id"]);
    if (!$library instanceof Library) {
        $data = "library not found";
        return $response->withJson($data, 404);
    }
    $library->delete();

    return $response->withJson($library, 200);
});
