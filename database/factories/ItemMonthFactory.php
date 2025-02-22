<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Month;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemMonthFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $itemId = Item::pluck('id')->toArray();
        $monthId = Month::pluck('id')->toArray();
        return [
            'item_id' => $this->faker->randomElement($itemId),
            'month_id' => $this->faker->randomElement($monthId),
            'user_id' => User::exists() ? User::pluck('id')->random() : User::factory(),
            'is_checked' => $this->faker->numberBetween(1, 2),
        ];
    }
}
