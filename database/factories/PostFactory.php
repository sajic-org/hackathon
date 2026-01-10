<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->title(),
            'content' => $this->generateRichText(),
        ];
    }

    protected function generateRichText(): string
    {
        return "<h2>" . fake()->catchPhrase() . "</h2>" .
            "<p><strong>" . fake()->sentence() . "</strong></p>" .
            "<p>" . fake()->realText(400) . "</p>" .
            "<blockquote>" . fake()->sentence() . "</blockquote>" .
            "<p>" . fake()->realText(200) . "</p>";
    }
}
