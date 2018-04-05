<?php
/**
 * PHP version 7
 * Routes aggregator - load all routes inside Routes dir
 */

$modelFiles = (array) glob(__DIR__ . '/../src/Model/*.php');
foreach ($modelFiles as $modelFile) {
    require $modelFile;
}
