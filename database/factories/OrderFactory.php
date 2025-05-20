<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hex = strtoupper(bin2hex(random_bytes(10)));
        $customer = Customer::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();
        $jumlah = fake()->numberBetween(1, 15);

        return [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'jumlah_dibeli' => $jumlah,
            'no_faktur' => "FK-$hex",
            'total_harga' => $product->harga * $jumlah,
        ];
    }
}
