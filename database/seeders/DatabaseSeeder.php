<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Category;
use App\Models\Product;
=======
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
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

<<<<<<< HEAD
      /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        // $this->call([

        // ]);


         Category::factory(4)->has(Category::factory(5)->has(Category::factory(5), 'subCategories'), 'subCategories')->create();


        Product::factory(1000)->create();

=======
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> 5270ef75c682166a1e9125b37f7f4c1d16bafa49
    }
}
