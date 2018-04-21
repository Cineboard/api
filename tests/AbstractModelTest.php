<?php

namespace Cineboard\Tests;

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class AbstractModelTest
 *
 * @package Cineboard\Tests
 */
abstract class AbstractModelTest extends TestCase
{
    /**
     * @beforeClass
     */
    public static function prepareEloquentConnection()
    {
        $configFile = __DIR__ . '/../app/src/settings.local.php';
        self::assertFileExists($configFile);

        $settings = include $configFile;
        self::assertInternalType('array', $settings);

        self::assertArrayHasKey('settings', $settings);
        self::assertArrayHasKey('database', $settings['settings']);

        $capsule = new Capsule;
        self::assertInstanceOf('Illuminate\Database\Capsule\Manager', $capsule);
        $capsule->addConnection($settings['settings']['database']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
