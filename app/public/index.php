<?php declare(strict_types=1);
/**
 * PHP version 7
 * Cineboard slim framework index.php
 *
 * @category Class
 * @package  Cineboard
 * @author   GB Pullarà <dev@firegarden.co>
 * @license  BSD-3-Clause https://opensource.org/licenses/BSD-3-Clause
 * @link     http://gitlab.com/cineboard
 */

use Slim\App;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

date_default_timezone_set("Europe/Rome");

// composer autoload
require __DIR__ . '/../../vendor/autoload.php';

session_start();

// TODO: use env [12factor]
// Instantiate the app - use local settings
$settings = require __DIR__ . '/../src/settings.local.php';
$app = new App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register Models
require __DIR__ . '/../src/models.php';

// Register Routes
require __DIR__ . '/../src/routes.php';

// Run!
$app->run();
