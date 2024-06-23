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
            'banner' => "https://images.unsplash.com/photo-1718634353354-fa2fc07e3080?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'score' => rand(1, 10),
            "content" => fake()->text(),
            'status' => 1,
            'published_at' => fake()->date('Y-m-d')
        ];
    }
}
