<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Discount;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(25),
            'price' => fake()->randomFloat(2, 1, 200),
            'stock' => fake()->numberBetween(100, 1000),
            'image' => 'products/EPadjzJHQL8gEhPHmF9BCuO9NMWiAP97XA1y8zB9.png',
            'active' => fake()->randomElement([true, false]),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
