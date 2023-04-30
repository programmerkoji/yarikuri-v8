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
        Item::factory(20)->create();
        Month::factory(20)->create();

        $this->call([
            UserSeeder::class,
            ItemMonthSeeder::class
        ]);
    }
}
