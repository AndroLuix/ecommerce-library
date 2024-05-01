<?php

namespace Database\Factories;

use App\Models\OrderPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderReturn>
 */
class OrderReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $order = OrderPayment::factory()->create();
        dump($order->id);
        
        return [
            'order_payment_id' =>$order->id,
            'motivation' => $this->faker->text(),
            'returned' => (rand(1, 10) % 2 == 0) ? true : false,
        ];
    }
}
