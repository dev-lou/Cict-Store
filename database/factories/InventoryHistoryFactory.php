<?php

namespace Database\Factories;

use App\Models\InventoryHistory;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryHistory>
 */
class InventoryHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = InventoryHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantityBefore = $this->faker->numberBetween(0, 100);
        $quantityChanged = $this->faker->numberBetween(-50, 50);
        $quantityAfter = max(0, $quantityBefore + $quantityChanged);

        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['stock_in', 'stock_out', 'adjustment']),
            'quantity_changed' => $quantityChanged,
            'quantity_before' => $quantityBefore,
            'quantity_after' => $quantityAfter,
            'reference' => $this->faker->word(),
            'notes' => $this->faker->sentence(),
        ];
    }
}
