<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowAuthorizedUserEditForm()
    {
        $user = User::find(2);
        $response =$this->actingAs($user)->get(route('users.edit',$user->id));
        $response->assertViewIs('users.edit');
    }

    public function testShowUnauthorizedUserEditForm()
    {
        $user = User::find(2);
        $response =$this->actingAs($user)->get(route('users.edit',4));
        $response->assertSessionHas('warning');
        $response->assertRedirect('/');
    }

    // public function testUpdateValidUserInfo()
    // {
    //     $user = User::find(6);
    //     $response = $this->actingAs($user)->put('/users/'.$user->id.'/',[
    //         'name'=>'abul22',
    //         'email'=>'abul@gsmail.com',
    //         'password'=>'secret',
    //         'password_confirmation' => 'secret'
    //     ]);
    //     $response->assertSessionHas('success');
    //     $response->assertRedirect('/');

    // }

    public function testUpdateEmptyUserInfo()
    {
        $user = User::find(6);
        $response = $this->actingAs($user)->put('/users/'.$user->id.'/',[
            'name'=>'',
            'email'=>'',
            'password'=>'',
            'password_confirmation' => ''
        ]);
        $response->assertSessionHasErrors();

    }

    public function testUpdateSameEmailUserInfo()
    {
        $user = User::find(6);
        $response = $this->actingAs($user)->put('/users/'.$user->id.'/',[
            'name'=>'abul',
            'email'=>'mjashem@hotmail.com',
            'password'=>'secret',
            'password_confirmation' => 'secret'
        ]);
        $response->assertSessionHasErrors();

    }
}
