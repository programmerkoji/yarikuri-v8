<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_months')->insert([
            [
                'item_id' => 1,
                'month_id' => 1,
                'is_checked' => 1
            ],
            [
                'item_id' => 2,
                'month_id' => 1,
                'is_checked' => 0
            ],
            [
                'item_id' => 3,
                'month_id' => 1,
                'is_checked' => 1
            ],
            [
                'item_id' => 1,
                'month_id' => 2,
                'is_checked' => 1
            ],
            [
                'item_id' => 2,
                'month_id' => 3,
                'is_checked' => 0
            ],
            [
                'item_id' => 3,
                'month_id' => 1,
                'is_checked' => 1
            ],
        ]);
    }
}
