<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderStatus::factory()->create(['name' => 'pending']);
        OrderStatus::factory()->create(['name' => 'processing']);
        OrderStatus::factory()->create(['name' => 'shipped']);
        OrderStatus::factory()->create(['name' => 'delivered']);
        OrderStatus::factory()->create(['name' => 'cancelled']);
    }
}
