<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        Tag::factory(20)->create();

        // Create 20 Categories
        Category::factory(20)->create();

        // Create 20 Articles and associate them with random tags and categories
        Article::factory(20)->create()->each(function ($article) {
            // Attach random tags to each article
            $article->tags()->attach(Tag::inRandomOrder()->take(3)->pluck('id'));

            // Attach a random category to each article
            $article->category()->associate(Category::inRandomOrder()->first());
            $article->save();
        });
    }
}
