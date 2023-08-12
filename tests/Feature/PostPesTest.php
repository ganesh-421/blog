<?php
uses(Illuminate\Foundation\Testing\RefreshDatabase);
use App\Models\User;
beforeEach(function () {
    $this->admin = User::factory()->create([
        'username' => "Ganesh@gmail.com",
    ]);
    $this->user = User::factory()->create();
})->uses(RefreshDatabase::class);

test('homepage contains empty marker', function () {
    $response = $this->get('/');
    $response->assertStatus(200);
    $response->assertSee("No posts found");
});
