<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(8),
            "slug" => Str::slug(fake()->sentence(6)),
            'blog_author_id' => 1,
            'blog_category_id' => rand(1, 6),
            'excerpt' => fake()->paragraph(2),
            'banner' => "posts/01J175J99SZ5ZN9HPJEGF3DZGQ.jpg",
            'score' => rand(1, 10),
            "content" => fake()->paragraphs(20, true),
            'status' => true,
            'published_at' => fake()->date('Y-m-d')
        ];
    }
}
