<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test',
                'email' => 'test@test.com',
                'password' => Hash::make('password1234'),
            ],
            [
                'name' => 'test02',
                'email' => 'test02@test.com',
                'password' => Hash::make('password1234'),
            ],
        ]);
    }
}
