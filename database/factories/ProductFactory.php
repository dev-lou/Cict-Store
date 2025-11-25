<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'base_price' => $this->faker->randomFloat(2, 10, 500),
            'current_stock' => $this->faker->numberBetween(0, 100),
            'low_stock_threshold' => $this->faker->numberBetween(5, 20),
            'image_path' => $this->faker->imageUrl(),
            'status' => 'active',
        ];
    }
}
