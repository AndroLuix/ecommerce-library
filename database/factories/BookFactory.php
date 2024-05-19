<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 0.01, 100),
          'category_id' => Category::all()->random()->id,
          'discount_id' => (rand(1,100) < 50)? null : Discount::all()->random()->id,
        //  'group_id' => (rand(1,100) > 50)? null : Group::all()->random()->id,
          'quantity' => rand(1,100),
            'image' => $this->faker->imageUrl(width:250, height: 400),
            'author' => $this->faker->name,
        ];
    }
}
