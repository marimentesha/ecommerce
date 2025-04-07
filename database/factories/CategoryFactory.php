<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['clothes', 'shoes', 'jewellery', 'food', 'tools', 'popular products', 'new items', 'sale']),
            'image' => 'products/EPadjzJHQL8gEhPHmF9BCuO9NMWiAP97XA1y8zB9.png',
            'parent_id' => fake()->randomElement([1, 2, 3])
        ];
    }
}
