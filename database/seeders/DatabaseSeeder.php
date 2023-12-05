<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionTableSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(BankInfoSeeder::class);
        
    }
}
