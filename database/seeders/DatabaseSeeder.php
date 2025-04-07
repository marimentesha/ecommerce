<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('categories')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        DB::table('discounts')->truncate();
        DB::table('user_details')->truncate();
        DB::table('products')->truncate();
        DB::table('cart_items')->truncate();
        DB::table('wishlist_items')->truncate();
        DB::table('payment_statuses')->truncate();
        DB::table('order_statuses')->truncate();
        DB::table('credit_cards')->truncate();
        DB::table('orders')->truncate();
        DB::table('reviews')->truncate();
        DB::table('feedback')->truncate();
        DB::table('order_items')->truncate();
        DB::table('payments')->truncate();
        DB::table('product_images')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call(CategorySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(UserDetailSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CartItemSeeder::class);
        $this->call(WishlistItemSeeder::class);
        $this->call(PaymentStatusSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(CreditCardSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(OrderItemSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProductImageSeeder::class);

    }
}
