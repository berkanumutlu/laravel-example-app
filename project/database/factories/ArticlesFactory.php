<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Articles>
 */
class ArticlesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence;
        return [
            'title'           => $title,
            'slug'            => Str::slug($title),
            'body'            => fake()->paragraph,
            'image'           => fake()->imageUrl(600, 400),
            'status'          => fake()->boolean,
            'tags'            => Str::slug(fake()->text, ','),
            'seo_keywords'    => Str::slug(fake()->paragraph, ','),
            'seo_description' => fake()->paragraph,
            'read_time'       => random_int(0, 3000),
            'view_count'      => random_int(0, 100),
            'like_count'      => random_int(0, 100),
            'publish_date'    => fake()->dateTime,
            'category_id'     => random_int(1, 10),
            'user_id'         => random_int(1, 10)
        ];
    }
}
