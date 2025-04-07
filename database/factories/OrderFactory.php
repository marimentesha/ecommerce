<?php

namespace Database\Factories;

use App\Models\CreditCard;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->name(),
            'total' => fake()->numberBetween(50, 500),
            'status_id' => OrderStatus::inRandomOrder()->first()->id,
            'payment_status_id' => PaymentStatus::inRandomOrder()->first()->id,
            'payment_method' => fake()->randomElement(['cash', 'card']),
            'credit_card_id' => CreditCard::inRandomOrder()->first()->id,
        ];
    }
}
