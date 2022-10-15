<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(25);
        $price = $this->faker->numberBetween(100,900);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(100),
            'image_name' => $this->faker->imageUrl(140,300),
            'price' => $price,
            'sale_price' => $price - 50
        ];
    }
}
