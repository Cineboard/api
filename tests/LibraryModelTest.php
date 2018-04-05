<?php

namespace Cineboard\Tests;

use Cineboard\Model\Library;

/**
 * Class TestTest
 *
 * @package Cineboard\Tests
 */
class LibraryModelTest extends AbstractModelTest
{
    /**
     * @test
     */
    public function canSelectAllLibraries()
    {
        $libraries = Library::all();
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $libraries
        );

        $this->assertTrue($libraries->count() > 0);
    }

    /**
     * @test
     */
    public function canSelectLibraryById()
    {
        $testId = 1;

        $library = Library::find($testId);
        $this->assertInstanceOf('Cineboard\Model\Library', $library);

        $this->assertEquals($testId, $library->id);
    }
}
