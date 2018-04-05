<?php

namespace Cineboard\Tests;

use Cineboard\Model\User;

/**
 * Class TestTest
 *
 * @package Cineboard\Tests
 */
class UserModelTest extends AbstractModelTest
{
    /**
     * @test
     */
    public function canSelectAllUsers()
    {
        $users = User::all();
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $users
        );

        $this->assertTrue($users->count() > 0);
    }

    /**
     * @test
     */
    public function canSelectUserById()
    {
        $testId = 1;

        $user = User::find($testId);
        $this->assertInstanceOf('Cineboard\Model\User', $user);

        $this->assertEquals($testId, $user->id);
    }
}
