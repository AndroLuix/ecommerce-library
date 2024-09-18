<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\Category;
use App\Models\CreditCard;
use App\Models\Discount;
use App\Models\Group;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\OrderReturn;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        Category::factory()->count(20)->create();
        Discount::factory()->count(3)->create();
       // Group::factory()->count(10)->create();

        Book::factory()->count(rand(50,100))->create();
        User::factory()->count(rand(100,200))->create();

        Address::factory()->count(rand(200,201))->create();

        CreditCard::factory()->count(rand(100,201))->create();

        BookReview::factory()->count(rand(200,500))->create();

        OrderItem::factory()->count(rand(50,100))->create();

        OrderDetail::factory()->count(rand(100,200))->create();
        
        OrderPayment::factory()->count(rand(100,200))->create();
        OrderReturn::factory()->count(rand(10,50))->create();
    }
    
}
