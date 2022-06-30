<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            
            "product_name" => $this->faker->title(),
            "product_quantity" => $this->faker->numberBetween($min = 1, $max = 100),
            "product_price" => $this->faker->numberBetween($min = 100, $max = 1000),
            "total_price" => $this->faker->numberBetween($min = 1000, $max = 10000),
            "user_id" => $this->faker->numberBetween($min = 1, $max = 10),
            
        ];
    }
}
