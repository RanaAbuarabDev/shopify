<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        // $this->call([

        // ]);


         Category::factory(4)->has(Category::factory(5)->has(Category::factory(5), 'subCategories'), 'subCategories')->create();


        Product::factory(1000)->create();

    }
}
