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
            'nama' => fake()->randomElement(['Smartphone', 'Laptop', 'Tablet']) . ' ' .
                fake()->randomElement(['Pro', 'Lite', 'Max', 'Ultra']) . ' ' .
                fake()->year(),
            'harga' => fake()->numberBetween(100000, 1000000),
            'stok' => fake()->numberBetween(50, 1000),
        ];
    }
}
