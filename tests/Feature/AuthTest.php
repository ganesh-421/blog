<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    private User $user;
    // if you want to avoid repeating the same code(like creating a user) in every test, you can use setUp() method
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    public function test_unauthenticated_user_cannot_access_posts_in_admin_panel()
    {
        $response = $this->get('/admin/posts');
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }
    public function test_adter_login_redirects_users_to_posts()
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);
        $resp = $this->post('/sessions', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $resp->assertRedirect('/');
        $resp->assertStatus(302);
        // $resp = $this->actingAs($user)->get('/login');
        // $resp->assertRedirect('/');

    }
    /**
     * in laravel resource, validation error returns 422 status code
     * in laravel resource, authentication error returns 401 status code
     * in laravel resource, authorization error returns 403 status code
     * in laravel resource, sucessfully stored resource returns 201 status code
     */
    public function test_api_returns_current_user_information()
    {
        $resp = $this->actingAs($this->user)->getJson('api/user');
        $resp->assertJson($this->user->toArray());
    }
}
