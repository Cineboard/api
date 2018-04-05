<?php
/**
 * PHP version 7
 * Routes aggregator - load all routes inside Routes dir
 */

$routeFiles = (array) glob(__DIR__ . '/../src/Routes/*.php');
foreach ($routeFiles as $routeFile) {
    require $routeFile;
}
