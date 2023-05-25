<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private User $admin;
    private User $user;
    private Category $category;
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'username' => 'Ganesh@gmail.com',
        ]);
        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();
    }
    public function test_homepage_contains_empty_marker()
    {
        $response = $this->actingAs($this->user)->get('/');
        $response->assertStatus(200);
        $response->assertSee("No posts found");
    }
    // public function test_admin_page_contains_empty_table()
    // {
    //     $response = $this->get('/admin/posts');

    //     $response->assertSee("No posts found");
    // }
    // AAA mantra, arrange, act, assert
    public function test_homepage_contains_posts_if_it_exists()
    {
        $post = Post::factory()->create();
        $response = $this->actingAs($this->user)->get('/');
        $response->assertDontSee('No posts found');
        // $response->assertSee('Test Post'); will return true if it found Test Post anywhere in the blade
        // to ensure that , the corresponding post is in the collection returned by controller....
        $response->assertViewHas('posts', function($posts) use ($post){
            return $posts->contains($post);
        });

    }
    public function test_post_pagination_working()
    {
        $posts = Post::factory(7)->create();
        $resp = $this->actingAs($this->user)->get('/');
        $last = $posts->last();
        $resp->assertViewHas('posts', function($posts) use ($last) {
            return !$posts->contains($last);
        });
    }
    public function test_admin_required_to_visit_admin_panel()
    {
        $resp = $this->actingAs($this->admin)->get('/admin/posts');
        $resp->assertStatus(200);
    }
    public function test_admin_required_to_see_dashboard_and_posts_manage_nav()
    {
        $resp = $this->actingAs($this->user)->get('/');
        $resp->assertDontSee('Dashboard');
        $resp->assertDontSee('New Post');
    }
    public function test_admin_can_see_dashboard_and_posts_manage_nav()
    {
        $resp = $this->actingAs($this->admin)->get('/');
        $resp->assertSee('Dashboard');
        $resp->assertSee('New Post');
    }
    public function test_non_admin_cant_visit_admin_panel()
    {
        $resp = $this->actingAs($this->user)->get('/admin/posts');
        $resp->assertStatus(403);
    }
    public function test_post_can_be_created_by_admin()
    {
        $post = [
            "user_id" => $this->user->id,
            "category_id" => $this->category->id,
            "slug" => 'test-post',
            "title" => 'Test Post',
            "excerpt" => 'Test Post Excerpt',
            "body" => 'Test Post Body',
            "thumbnail" => UploadedFile::fake()->image('thumbnail.jpg'),
        ];
        $resp = $this->actingAs($this->admin)->post('/admin/posts', $post);
        $resp->assertStatus(302);
        $resp->assertRedirect('/');
        $this->assertDatabaseHas('posts', [
            'title' => $post['title'],
            "slug" => $post['slug'],
        ]);

        // ensure that the post is created right now(i.e not older post)
        $lastPost = Post::latest()->first();
        $this->assertEquals($lastPost->title, $post['title']);
        $this->assertEquals($lastPost->slug, $post['slug']);
    }
    public function test_post_edit_form_contains_correct_values()
    {
        $post = Post::factory()->create();
        $resp = $this->actingAs($this->admin)->get('/admin/posts/' . $post->slug . '/edit');
        $resp->assertStatus(200);
        $resp->assertSee('value="' .  $post->title . '"', false);
        $resp->assertSee('value="' .  $post->slug . '"', false);
        // $resp->assertSee('value="' .  strip_tags($post->excerpt) . '"', false);
        // $resp->assertSee('value="' .  strip_tags($post->body) . '"', false);
        // $resp->dd();
        // $resp->assertSee('value="' .  $post->excerpt . '"', false);
        // $resp->assertSee('value="' .  $post->body . '"', false);
        $resp->assertViewHas('post', $post);

    }
}
