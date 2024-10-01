<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $categories = ["Space", "Football", "Politic", "Military", "Programming", "Artificial intelligence"];

        foreach ($categories as $category) {
            Category::create([
                "name" => $category,
                "slug" => Str::slug($category),
                "thumbnail" => "categories/" . Str::slug($category) .
                    '.jpg',
                "description" => "This is posts about " . $category
            ]);
        }

        $authorProfilePictures = ['Author-1.jpg', 'Author-2.jpg', 'Author-3.jpg', 'Author-4.jpg', 'Author-5.jpg', 'Author-6.jpg'];

        foreach ($authorProfilePictures as $profilePicture) {
            Author::create([
                'name' => fake()->name,
                'position' => fake()->jobTitle,
                'profile_picture' => 'authors/' . $profilePicture,
                'bio' => fake()->sentence,
                'email' => fake()->unique()->safeEmail,
            ]);
        }

        Post::factory(30)->create();
    }
}
