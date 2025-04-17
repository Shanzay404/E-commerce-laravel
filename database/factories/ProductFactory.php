<?php

namespace Database\Factories;

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
            'product_title' => fake()->word(),
            'product_description' => collect(fake()->paragraphs(mt_rand(5, 20)))->join(' '),
            'product_image' => fake()->imageUrl(),
            'category_id' => fake()->numberBetween(1,12),
            'quantity' => fake()->numberBetween(1,50),
            'price' => fake()->randomFloat(2, 1000, 5000),
        ];
    }
}
