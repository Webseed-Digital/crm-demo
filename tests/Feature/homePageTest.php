<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class homePageTest extends TestCase
{
    /**
     * Ensure that unauthenticated users are redirect to login
     *
     * @return void
     */
    public function testRedirectUnauthenticatedUsers()
    {
        $response = $this->get('/');

        // We're not logged in, so we should be redirected to log in
        $response->assertRedirect('/login');
    }

    public function testRedirectAuthenticatedUsers()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                         ->get('/');

        // Since we're logged in we should be taken to the dashboard
        $response->assertRedirect('/dashboard');
    }

    public function testCannotRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(404);
    }
}
