<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class, 'user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->integer('total');
            $table->foreignIdFor(\App\Models\OrderStatus::class,'status_id')->default(1);
            $table->foreignIdFor(\App\Models\PaymentStatus::class,'payment_status_id')->default(1);
            $table->enum('payment_method', ['cash', 'card']);
            $table->foreignIdFor(\App\Models\CreditCard::class, 'credit_card_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
