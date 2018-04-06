<?php

namespace Cineboard\Tests;

use Cineboard\Model\Category;

/**
 * Class CategoryModelTest
 *
 * @package Cineboard\Tests
 */
class CategoryModelTest extends AbstractModelTest
{
    /**
     * @test
     */
    public function canSelectAllCategories()
    {
        $categories = Category::all();
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $categories
        );

        $this->assertTrue($categories->count() > 0);
    }

    /**
     * @test
     */
    public function canSelectCategoryById()
    {
        $testId = 1;

        $category = Category::find($testId);
        $this->assertInstanceOf('Cineboard\Model\Category', $category);

        $this->assertEquals($testId, $category->id);
    }
}
