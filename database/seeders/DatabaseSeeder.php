<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ["Space", "Football", "Politic", "Military", "Programming", "Artificial intelligence"];

        foreach ($categories as $category) {
            Category::create([
                "name" => $category,
                "slug" => Str::slug($category),
                "thumbnail" => "https://plus.unsplash.com/premium_photo-1718146018251-1e59e5d6f2a1?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNXx8fGVufDB8fHx8fA%3D%3D",
                "description" => "This is posts about " . $category
            ]);
        }

        Author::create([
            'name' => 'Aiman Yusuf',
            "position" => "Web Developer",
            "profile_picture" => "https://media.licdn.com/dms/image/D5603AQGL4nkmtkSM9Q/profile-displayphoto-shrink_400_400/0/1713844916125?e=2147483647&v=beta&t=pf_eMS5BVvAEdJaLgrUl3j5mbdU7wO6HkhGLq6Hlask",
            "bio" => "Hello my name is aiman",
            "email" => "aimanyusufdev@gmail.com",
        ]);

        Post::factory(10)->create();
    }
}
