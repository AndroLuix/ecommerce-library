<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = User::all()->random();
        $quantity = rand(1,2);
        $total = $book->price * $quantity;
        return [
            'user_id' => User::all()->random()->id,
            'book_id' => $book->id,
            'inviato' => true,
            'quantity' =>  $quantity,
            'returned_order' => (rand(1,10) % 2 == 0)? 0 : 1,
            'totalPrice' => $total,

        ];
    }
}
