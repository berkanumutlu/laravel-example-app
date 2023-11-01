<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleComments>
 */
class ArticleCommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment'       => fake()->text,
            'status'        => fake()->boolean,
            'like_count'    => random_int(0, 100),
            'dislike_count' => random_int(0, 20),
            'article_id'    => random_int(1, 10),
            'user_id'       => random_int(1, 10)
        ];
    }
}
