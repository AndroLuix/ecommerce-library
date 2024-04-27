<?php

namespace Database\Factories;

use App\Models\CreditCard;
use App\Models\OrderItem;

use Ramsey\Uuid\Uuid;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $order = OrderItem::all()->random(); 
        if((rand(1,10) % 2 == 0)){
           $userCardId = CreditCard::all()->random()->id;
           $mark = false;
           

        }else{
            $userCardId = null;
            $mark = true;
        }
        dump($order->id);
        dump($userCardId);
        return [
            'order_id' => $order->id,
            'card_credit_id' => $userCardId,
            'mark' => $mark,
            'reso' =>  (rand(1,10) % 2 == 0)? true : false,
            'amount' => rand(20,500),
            'transaction_id' => Uuid::uuid4()->toString(),
        ];
    }
}
