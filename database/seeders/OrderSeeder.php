<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(5)->create()->each(function($order) {
            $items = OrderItem::factory(rand(1,3))->make();
            $total = 0;

            foreach ($items as $item) {
                $item->order_id = $order->id;
                $item->save();
                $total += $item->price * $item->quantity;
            }

            $order->update(['total_amount' => $total]);
        });
    }
}
