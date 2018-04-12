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
    /**
     * Parse request body
     */
    $parsedBody = $request->getParsedBody();

    /**
     * Start body fields check
     */

    if (!isset($parsedBody['user_id'])) {
        $data = "user_id cannot be null";
        return $response->withJson($data, 400);
    } else {
        $userId = $parsedBody['user_id'];
    }

    if (!isset($parsedBody['title'])) {
        $data = "title cannot be null";
        return $response->withJson($data, 400);
    } else {
        if (mb_strlen($parsedBody['title'], 'UTF-8') > 200) {
            $data = "title too long: max 200 chars";
            return $response->withJson($data, 400);
        }
        $title = $parsedBody['title'];
    }

    if (isset($parsedBody['director'])) {
        if (mb_strlen($parsedBody['director'], 'UTF-8') > 50) {
            $data = "director too long: max 50 chars";
            return $response->withJson($data, 400);
        }
        $director = $parsedBody['director'];
    }

    if (isset($parsedBody['url'])) {
        if (mb_strlen($parsedBody['url'], 'UTF-8') > 300) {
            $data = "url too long: max 300 chars";
            return $response->withJson($data, 400);
        }
        $url = $parsedBody['url'];
    }

    if (isset($parsedBody['tags'])) {
        if (mb_strlen($parsedBody['tags'], 'UTF-8') > 500) {
            $data = "tags too long: max 500 chars";
            return $response->withJson($data, 400);
        }
        $tags = $parsedBody['tags'];
    }

    if (isset($parsedBody['notes'])) {
        if (mb_strlen($parsedBody['notes'], 'UTF-8') > 500) {
            $data = "notes too long: max 500 chars";
            return $response->withJson($data, 400);
        }
        $notes = $parsedBody['notes'];
    }

    // TODO: sanity check
    if (isset($parsedBody['rating'])) {
        $rating = $parsedBody['rating'];
    }
    if (isset($parsedBody['viewed'])) {
        $viewed = $parsedBody['viewed'];
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
    /**
     * Parse request body
     */
    $parsedBody = $request->getParsedBody();

    /**
     * Check existence for element to update
     */

    $library = Library::find($args['id']);
    // check instanceof instead of obj
    if (!$library instanceof Library) {
        $data = "library to update not found";
        return $response->withJson($data, 404);
    }

    /**
     * Start body fields check
     * NOTE: move check on model ???
     */

    // check db fields limits and null/not null

    if (!isset($parsedBody['user_id'])) {
        $data = "user_id cannot be null";
        return $response->withJson($data, 400);
    } else {
        $library->user_id = $parsedBody['user_id'];
    }

    if (!isset($parsedBody['title'])) {
        $data = "title cannot be null";
        return $response->withJson($data, 400);
    } else {
        if (mb_strlen($parsedBody['title'], 'UTF-8') > 200) {
            $data = "title too long: max 200 chars";
            return $response->withJson($data, 400);
        }
        $library->title = $parsedBody['title'];
    }

    if (isset($parsedBody['director'])) {
        if (mb_strlen($director, 'UTF-8') > 50) {
            $data = "director too long: max 50 chars";
            return $response->withJson($data, 400);
        }
        $library->director = $parsedBody['director'];
    }

    if (isset($parsedBody['url'])) {
        if (mb_strlen($url, 'UTF-8') > 300) {
            $data = "url too long: max 300 chars";
            return $response->withJson($data, 400);
        }
        $library->url = $parsedBody['url'];
    }

    if (isset($parsedBody['tags'])) {
        if (mb_strlen($tags, 'UTF-8') > 500) {
            $data = "tags too long: max 500 chars";
            return $response->withJson($data, 400);
        }
        $library->tags = $parsedBody['tags'];
    }

    if (isset($parsedBody['notes'])) {
        if (mb_strlen($notes, 'UTF-8') > 500) {
            $data = "notes too long: max 500 chars";
            return $response->withJson($data, 400);
        }
        $library->notes = $parsedBody['notes'];
    }

    // TODO: sanity check
    if (isset($parsedBody['rating'])) {
        $library->rating = $parsedBody['rating'];
    }
    if (isset($parsedBody['viewed'])) {
        $library->viewed = $parsedBody['viewed'];
    }

    if (array_key_exists('deleted_at', $parsedBody)) {
        if (is_integer($parsedBody['deleted_at'])) {
            /**
             * If submitted date is a timestamp, convert it to db date format
             */
            $parsedBody['deleted_at'] = date('Y-m-d H:i:s');
        }
    }

    $library->save();
    $app->getContainer()->get('logger')->info("LIBRARY EDITED " . var_export($library['title'], true));

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
