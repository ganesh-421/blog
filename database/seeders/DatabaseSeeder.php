<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    /*  ----If you want to swipe old data everytime you seed the database----
        User::truncate();
        Category::truncate();
        Post::truncate();
    */
    /*   ----You can sedd dummy data using factory.----   
        $user = User::factory()->create();
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    */
        $user = User::factory()->create([
            'name' => "Ganesh Adhikari"
        ]);
        Post::factory(5)->create([
            'user_id' =>$user->id
        ]); //This will create 5 posts, 1 user(bcoz user_id already given) and 5 categories

    /*  -----You can seed your own Data to database------
        $personal = Category::create([
            "name" => "Personal",
            "slug" => "personal"
        ]);
        $family = Category::create([
            "name" => "Family",
            "slug" => "family"
        ]);
        $work = Category::create([
            "name" => "Work",
            "slug" => "work"
        ]);
        Post::create([
            "user_id" => $user->id,
            "category_id" => $family->id,
            "title" => "<p>My Family Post</p>",
            "slug" => "my-family-post",
            "excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ",
            "body" => "<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. 
                Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo 
                magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                Proin pharetra nonummy pede. Mauris et orci.Aenean nec lorem. In porttitor. 
                Donec laoreet nonummy augue.Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis,
                nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.</p>
            "
        ]);
        Post::create([
            "user_id" => $user->id,
            "category_id" => $work->id,
            "title" => "<p>My Work Post</p>",
            "slug" => "my-work-post",
            "excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ",
            "body" => "<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. 
                Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo 
                magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                Proin pharetra nonummy pede. Mauris et orci.Aenean nec lorem. In porttitor. 
                Donec laoreet nonummy augue.Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis,
                nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.</p>
            "
        ]);
        Post::create([
            "user_id" => $user->id,
            "category_id" => $personal->id,
            "title" => "<p>My Personal Post</p>",
            "slug" => "my-personal-post",
            "excerpt" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. ",
            "body" => "<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. 
                Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo 
                magna eros quis urna. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                Proin pharetra nonummy pede. Mauris et orci.Aenean nec lorem. In porttitor. 
                Donec laoreet nonummy augue.Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis,
                nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.</p>
            "
        ]);
    */
    }
}
