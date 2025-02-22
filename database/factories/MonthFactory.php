<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MonthFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year' => $this->faker->numberBetween(2021, 2023),
            'month' => $this->faker->numberBetween(1, 12),
            'user_id' => User::exists() ? User::pluck('id')->random() : User::factory(),
        ];
    }
}
