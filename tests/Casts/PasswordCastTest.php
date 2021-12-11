<?php

namespace Lioneagle\LeUtils\Tests\Casts;

use Illuminate\Support\Facades\Hash;
use Lioneagle\LeUtils\Tests\Models\User;
use Lioneagle\LeUtils\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class PasswordCastTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_casts_the_password()
    {
        $password = 'Password123!@#';

        $user = $this->createUser($password);

        $this->assertTrue(Hash::check($password, $user->password));
    }

    protected function createUser(string $password)
    {
        return User::create([
            'name' => 'name',
            'password' => $password,
        ]);
    }
}
