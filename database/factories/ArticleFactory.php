<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'full_text' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(800, 600, 'business'), // Or you can specify a path
            'user_id' => User::factory(), // Link to a random user
            'category_id' => Category::factory(), // Link to a random category
        ];
    }
}
