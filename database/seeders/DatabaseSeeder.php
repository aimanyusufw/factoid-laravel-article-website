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

        $authors = [
            ["name" => "David Brown", "jobTitle" => "Full Stack Developer"],
            ["name" => "Sophia Wilson", "jobTitle" => "Marketing Specialist"],
            ["name" => "William Martinez", "jobTitle" => "Cloud Engineer"],
            ["name" => "Isabella Taylor", "jobTitle" => "AI Researcher"],
            ["name" => "James Lee", "jobTitle" => "DevOps Engineer"],
            ["name" => "Olivia Anderson", "jobTitle" => "Cybersecurity Analyst"]
        ];

        foreach ($authors as $index => $author) {
            Author::create([
                'name' => $author['name'],
                'position' => $author['jobTitle'],
                'profile_picture' => 'authors/Author-' . $index + 1 . ".jpg",
                'bio' => "Hello my name is " . $author['name'] . " and i'am as a" . $author['jobTitle'],
                'email' => $author['name'] . "@aimanyusuf.site",
            ]);
        }

        Post::factory(30)->create();
    }
}
