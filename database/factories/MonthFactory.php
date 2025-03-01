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
            'year' => 2025,
            'month' => 3,
            'user_id' => User::factory(),
        ];
    }

    public function withUniqueData()
    {
        $users = User::pluck('id')->toArray();
        $months = range(1, 12);
        $years = range(2020, 2030);

        return $this->sequence(
            fn ($seq) => [
                'year' => $years[$seq->index % count($years)],
                'month' => $months[$seq->index % count($months)],
                'user_id' => $users[$seq->index % count($users)],
            ]
        );
    }
}
