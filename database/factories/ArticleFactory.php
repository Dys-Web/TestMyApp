<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence;

        $context =  fake()->paragraphs(asText:true);

        $instruction = fake()->paragraphs(asText: true);

        $created_at = fake()->dateTimeBetween('-1 year');
        
        return [
            'title' => fake()->unique()->sentence,

            'slug' => Str::slug($title),

            'description' => Str::limit($context,300),

            'context' => $context,

            'instruction' => $instruction,

            'created_at' => $created_at,

            'updated_at' => $created_at,

            //
        ];
    }
}
