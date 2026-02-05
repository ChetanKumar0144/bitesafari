<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 50, 500);

        return [
            'order_id' => Order::factory(),
            'food_name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $price,
        ];
    }
}
