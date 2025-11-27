<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->realText(20),
            'description' => $this->faker->realText(200),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'category_id' => $this->faker->randomElement(Category::query()->pluck('id')->toArray())
        ];
    }
}
