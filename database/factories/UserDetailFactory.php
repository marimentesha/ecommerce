<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->unique()->randomElement(User::pluck('id')->toArray()),
            'address1' => fake()->address(),
            'address2' => fake()->streetAddress(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'zip_code' => fake()->postcode(),
            'phone' => fake()->phoneNumber(),
            ];
    }
}
