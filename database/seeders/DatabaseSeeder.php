<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Month;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
            MonthSeeder::class,
            ItemMonthSeeder::class,
        ]);
    }
}
