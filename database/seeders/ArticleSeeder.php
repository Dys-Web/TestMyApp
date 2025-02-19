<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $images = [
            'abvanceclini.jpg',
            'advanced.jpeg',
            'cerave.jpg',
            'clinical.png',
            'emergenc.jpg',
            'gbc.png',
            'herbist.jpg',
            'hiisees.jpg',
            'Ici.png',
            'logo.jpg',
            'Multivitamin.jpg',
            'nature.jpg',
            'palmers.jpg',
            'parici.png',
            'Radiance.jpg',
            'rocheposey.jpg',
        ];

        Article :: factory(15)
            ->sequence(fn() =>[
                'category_id' => $categories->random()->id,
                'image' => $images[array_rand($images)],
            ])    
            ->create();

    }
}
