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
    public function test_login_redirects_to_posts()
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
}
