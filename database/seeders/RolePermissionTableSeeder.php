<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{

    public function run()
    {
        $nowtime = now()->toDateTimeString();
        DB::table('roles')->insert([
            ['name' => 'Managing Director', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Accountant', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Master Agent', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Agent', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Customer', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Investor', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
            ['name' => 'Stuff', 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime],
        ]);
        
        $superadmin = User::create([
            'email' => 'admin@gmail.com',
            'email_verified_at' => $nowtime,
            'password' => '$2y$10$yFSZxg.O/3lmsZBpN5B/QOcft6DGE2txfE.QSojU/Ih4nYfjNYVYu',
            'status' => 1
        ]);

        DB::table('user_details')->insert([
            [
                'account_id' => 'Gm11111111',
                'name' => 'General Manager',
                'phone' => '01222222222',
                'present_address' => 'present address',
                'permanent_address' => 'permanent address',
                'emergency_contact' => '01222222222',
                'occupation' => 'General Manager',
                'role' => 1,
                'income' => 0,
                'total_kata' => 0,
                'user_id' => 1
            ]
        ]);

        $superadmin->assignRole('Managing Director');
    }
}
