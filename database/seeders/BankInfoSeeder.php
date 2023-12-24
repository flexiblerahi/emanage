<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankInfoSeeder extends Seeder
{
    public function run(): void
    {
        $nowtime = now()->toDateTimeString();

        DB::table('bank_names')->insert([
            [
                'name' => 'Demo Bank',
                'status' => 1,
                'entry' => 1,
                'created_at' => $nowtime,
                'updated_at' => $nowtime
            ]
        ]);

        DB::table('bank_infos')->insert([
            [
                'bank_name_id' => 1,
                'account_id' => '11111111111111',
                'address' => 'Default Account',
                'status' => 1,
                'amount' => 0,
                'entry' => 1,
                'created_at' => $nowtime,
                'updated_at' => $nowtime
            ]
        ]);
    }
}
