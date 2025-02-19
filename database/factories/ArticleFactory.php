<?php

namespace Database\Factories;

use App\Models\Category;
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

        $imageText = fake()->word;
        // Générer une couleur de fond et une couleur de texte aléatoires
        $bgColor = sprintf('%02x%02x%02x', rand(0, 255), rand(0, 255), rand(0, 255)); // Couleur de fond
        $textColor = sprintf('%02x%02x%02x', rand(0, 255), rand(0, 255), rand(0, 255)); // Couleur du texte

   

        
        return [
            'title' => fake()->unique()->sentence,

            'slug' => Str::slug($title),

            'description' => Str::limit($context,300),

            'context' => $context,

           'image' => "https://placehold.co/600x400/{$bgColor}/{$textColor}?text={$imageText}",

            'instruction' => $instruction,

            "category_id" => Category::inrandomOrder()->first()->id,

            'created_at' => $created_at,

            'updated_at' => $created_at,

            //
        ];
    }
}
