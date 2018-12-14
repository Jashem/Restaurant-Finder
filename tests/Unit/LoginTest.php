<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testLoginFormDisplayed()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
    }

    public function testLoginValidUser()
    {
        $response = $this->post('/login', [
            'email' => "mjashem@hotmail.com",
            'password' => bcrypt('123456')
        ]);
        $response->assertRedirect('/');
    }

    public function testLoginInvalidUser()
    {
        $response = $this->post('/login', [
            'email' => "mjashem@totmail.com",
            'password' => bcrypt('12345678')
        ]);
        $response->assertSessionHasErrors();
    }
   
}