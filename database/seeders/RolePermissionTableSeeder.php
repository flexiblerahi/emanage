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
            ['name' => 'Administrator', 'guard_name' => 'web', 'is_auth' => 1, 'created_at' => $nowtime, 'updated_at' => $nowtime],
        ]);
        
        $superadmin = User::create([
            'email' => 'admin@gmail.com',
            'email_verified_at' => $nowtime,
            'role' => 1,
            'password' => '$2y$10$yFSZxg.O/3lmsZBpN5B/QOcft6DGE2txfE.QSojU/Ih4nYfjNYVYu',
            'status' => 1
        ]);

        DB::table('user_details')->insert([
            [
                'account_id' => '10000000',
                'name' => 'Administrator',
                'phone' => '01222222222',
                'present_address' => 'present address',
                'permanent_address' => 'permanent address',
                'emergency_contact' => '01222222222',
                'occupation' => 'Administrator',
                'role' => 1,
                'user_id' => 1
            ]
        ]);

        $superadmin->assignRole('Administrator');
    }
}
