<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'amount' => fake()->numberBetween(100, 1000),
            'account_number' => fake()->creditCardNumber,
            'status'  => fake()->randomElement(['pending', 'successful', 'failed']),
            'transaction_id'  => fake()->unique()->randomNumber(),
        ];
    }
}
