<?php

namespace Database\Seeders;

use App\Models\ItemMonth;
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
        ItemMonth::factory(10)->create();
        // DB::table('item_months')->insert([
        //     [
        //         'item_id' => 1,
        //         'month_id' => 1,
        //         'is_checked' => 1,
        //         'user_id' => 1
        //     ],
        //     [
        //         'item_id' => 2,
        //         'month_id' => 1,
        //         'is_checked' => 0,
        //         'user_id' => 2
        //     ],
        //     [
        //         'item_id' => 3,
        //         'month_id' => 1,
        //         'is_checked' => 1,
        //         'user_id' => 1
        //     ],
        //     [
        //         'item_id' => 1,
        //         'month_id' => 2,
        //         'is_checked' => 1,
        //         'user_id' => 2
        //     ],
        //     [
        //         'item_id' => 2,
        //         'month_id' => 3,
        //         'is_checked' => 0,
        //         'user_id' => 1
        //     ],
        //     [
        //         'item_id' => 3,
        //         'month_id' => 1,
        //         'is_checked' => 1,
        //         'user_id' => 1
        //     ],
        // ]);
    }
}
