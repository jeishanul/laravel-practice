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
            'name' => fake()->name(),
            'slug' => fake()->slug(),
            'barcode' => fake()->ean13(),
            'stock' => fake()->numberBetween(0, 100),
            'price' => fake()->numberBetween(100, 1000),
            'description' => fake()->text(200),
            'image' => fake()->imageUrl(640, 480, 'animals', true)
        ];
    }
}
