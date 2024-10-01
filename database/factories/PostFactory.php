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
        $postsImages = [];

        return [
            'title' => fake()->sentence(8),
            "slug" => Str::slug(fake()->sentence(6)),
            'blog_author_id' => rand(1, 6),
            'blog_category_id' => rand(1, 6),
            'excerpt' => fake()->paragraph(2),
            'banner' => "posts/posts-" . rand(1, 12) . ".jpg",
            'score' => rand(1, 10),
            "content" => implode("\n\n", [
                "<h2>" . $this->faker->sentence(4) . "</h2>",
                "<ul>" .
                    "<li><strong>" . $this->faker->sentence(4) . ":</strong> " . $this->faker->sentence(12) . " The open layout allows for seamless flow between the living, dining, and kitchen areas, providing a perfect space for entertainment and relaxation.</li>" .
                    "<li><strong>" . $this->faker->sentence(4) . ":</strong> " . $this->faker->sentence(10) . " Situated in a highly sought-after neighborhood, this property offers easy access to local amenities, schools, and public transportation.</li>" .
                    "<li><strong>" . $this->faker->sentence(4) .  ":</strong> " . $this->faker->sentence(10) . " Equipped with state-of-the-art appliances and smart home features, this property ensures convenience and luxury at every turn.</li>" .
                    "<li><strong>" . $this->faker->sentence(4) . ":</strong> " . $this->faker->sentence(15) . " Enjoy the beautiful backyard, perfect for gardening, family gatherings, or simply relaxing under the sun.</li>" .
                    "</ul>",
                "<h3>" . $this->faker->sentence(5) . "</h3>",
                "<p>" . $this->faker->sentence(32) . "</p>",
                "<p>" . $this->faker->sentence(25) . "</p>"
            ]),
            'status' => true,
            'published_at' => fake()->date('Y-m-d')
        ];
    }
}
