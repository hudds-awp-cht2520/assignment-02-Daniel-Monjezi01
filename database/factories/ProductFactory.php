<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'price' => random_int(1, 10),
        ];
    }
}