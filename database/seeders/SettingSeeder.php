<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            ['key' => 'company_name', 'value' => 'Real Estate', 'group_id' => 1],
            ['key' => 'icon', 'value' => null, 'group_id' => 1],
            ['key' => '', 'value' => 'web', 'group_id' => 1],
        ]);
    }
}
