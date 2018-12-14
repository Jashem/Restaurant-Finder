<?php

namespace Tests\Unit;
use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterFormDisplayed()
    {
        $response = $this->get('/register');
        $response->assertSuccessful();
    }

    public function testRegistersValidUser()
    {
        $user = factory(User::class)->make([
            'name' => "mofij",
            'email' => "mofij@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function testDoesNotRegisterInvalidUserWithWrongPassword()
    {
        $user = factory(User::class)->make([
            'name' => "mokhlace",
            'email' => "mokhlace@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'invalid'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    public function testDoesNotRegisterInvalidUserWithSameEmail()
    {
        $user = factory(User::class)->make([
            'name' => "mokhlace",
            'email' => "mofij@gmail.com",
        ]);
        $response = $this->post('register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

}
