<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentStatus::factory()->create(['name' => 'unpaid']);
        PaymentStatus::factory()->create(['name' => 'paid']);
        PaymentStatus::factory()->create(['name' => 'failed']);
        PaymentStatus::factory()->create(['name' => 'refunded']);
        PaymentStatus::factory()->create(['name' => 'cancelled']);
    }
}
