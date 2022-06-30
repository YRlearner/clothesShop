<?php

namespace Database\Factories;
use Illuminate\Support\Str;
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
    public function definition()
    {
        return [
            //
            "name" => $this->faker->name(),
            "slug" => Str::slug($this->faker->name()),
            "description" => $this->faker->text(),
            "price" => $this->faker->numberBetween($min = 100, $max = 1000),
            "old_price" => $this->faker->numberBetween($min = 100, $max = 1000),
            "image" => $this->faker->imageUrl($width = 640, $height = 480),
            "in_stock" => $this->faker->numberBetween($min = 1, $max = 100),
            "category_id" => $this->faker->numberBetween(1, 10),
            
        ];
    }
}
