<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'price' => $this->faker->numberBetween(1000, 10000),
            'user_id' => User::exists() ? User::pluck('id')->random() : User::factory(),
        ];
    }
}
