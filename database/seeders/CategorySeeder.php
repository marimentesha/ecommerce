<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'popular products',
            'image' => 'photos/convenience.png']);

        Category::factory()->create([
            'name' => 'new items',
            'image' => 'photos/convenience.png']);

        Category::factory()->create([
            'name' => 'sale',
            'image' => 'photos/convenience.png']);

        Category::factory()->create([
            'name' => 'clothes',
            'image' => 'photos/convenience.png']);

        Category::factory()->create([
            'name' => 'shoes',
            'image' => 'photos/convenience.png',
            'parent_id' => 1,
        ]);

        Category::factory()->create([
            'name' => 'jewellery',
            'image' => 'photos/convenience.png',
            'parent_id' => 2,
        ]);

        Category::factory()->create([
            'name' => 'food',
            'image' => 'photos/convenience.png',
            'parent_id' => 3,
        ]);

        Category::factory()->create([
            'name' => 'tools',
            'image' => 'photos/convenience.png',
            'parent_id' => 2,
        ]);

    }
}
