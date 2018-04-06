<?php declare(strict_types=1);
/**
 * PHP version 7
 * Model aggregator - load all models inside Model dir
 */

$modelFiles = (array) glob(__DIR__ . '/../src/Model/*.php');
foreach ($modelFiles as $modelFile) {
    require $modelFile;
}
