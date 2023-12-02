<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $nowtime = now()->toDateTimeString();
        DB::table('users')->insert([
            [
                'email' => 'admin@gmail.com',
                'email_verified_at' => $nowtime,
                'password' => '$2y$10$yFSZxg.O/3lmsZBpN5B/QOcft6DGE2txfE.QSojU/Ih4nYfjNYVYu',
                'status' => 1
            ]
        ]);

        DB::table('user_details')->insert([
            [
                'account_id' => 'Gm11111111',
                'name' => 'General Manager',
                'phone' => '01222222222',
                'present_address' =>  fake()->address(),
                'permanent_address' => fake()->address(),
                'emergency_contact' => '01222222222',
                'occupation' => 'General Manager',
                'role' => 1,
                'income' => 0,
                'total_kata' => 0,
                'user_id' => 1
            ]
        ]);
    }
}
