<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionSeeder extends Seeder
{
    public function run(): void
    {
        $nowtime = now()->toDateTimeString();
        DB::table('commissions')->insert([
            ['type' => 0, 'user_details_id' => 1, 
             'rank1' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank2' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank3' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['type' => 1, 'user_details_id' => 1, 
             'rank1' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank2' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank3' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['type' => 2, 'user_details_id' => 1,
             'rank1' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank2' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}',
             'rank3' => '{"hand1": 0, "hand2": 0, "hand3": 0, "shareholder": 0}', 
             'created_at' => $nowtime, 'updated_at' => $nowtime],
        ]);
    }
}
