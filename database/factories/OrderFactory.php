<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $statuses = ['pending', 'accepted', 'preparing', 'delivered'];

        return [
            'order_no' => strtoupper(Str::random(8)),
            'customer_name' => $this->faker->name,
            'customer_phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement($statuses),
            'total_amount' => 0, // calculate later
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
