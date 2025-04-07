<?php

namespace Database\Factories;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'last_four_digits' => substr(fake()->creditCardNumber, -4),
            'card_type' => fake()->creditCardType(),
        ];
    }
}
