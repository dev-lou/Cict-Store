<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 100, 5000);
        $tax = $subtotal * 0.12; // 12% tax
        $total = $subtotal + $tax;

        return [
            'user_id' => User::factory(),
            'assigned_staff_id' => null,
            'order_number' => 'ORD-' . $this->faker->unique()->numberBetween(10000, 99999),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'notes' => $this->faker->sentence(),
        ];
    }
}
