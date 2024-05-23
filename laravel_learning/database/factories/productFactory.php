<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "ProductName" => fake() -> name(),
            "ProductCateId" => fake() -> numberBetween(1,10),
            "BrandName" =>  fake() -> name(),
            "Price" => fake() -> numberBetween(100,1000),
            "Image" => fake() -> imageUrl( 640, 480,'product', TRUE),
        ];
    }
}
