<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $allpermissions = array();
        $allrolehaspermissions = array();
        $count_permissions = 0;
        $nowtime = now()->toDateTimeString();
        $permissions = [
            'withdraw-list', 'new-withdraw', 'withdraw-edit',
            'report-withdraw', 'report-transaction', 
            'commission-list', 'commission-view', 'commission-edit',
            'role-list', 'permission-edit',
            'expense-type-list', 'new-expense-type', 'expense-type-edit', 'expense-type-view', 'expense-type-delete',
            'expense-list', 'new-expense', 'expense-edit', 'expense-view',
            'salary-type-list', 'new-salary-type', 'salary-type-edit', 'salary-type-delete',
            'salary-list', 'new-salary', 'salary-edit', 'salary-view',
            'bank-name-list', 'new-bank-name', 'bank-name-edit', 'bank-name-view',
            'bank-info-list', 'new-bank-info', 'bank-info-edit', 'bank-info-view',
            'deposit-list', 'new-deposit', 'deposit-edit', 'deposit-view',
        ];
        foreach ($permissions as $permission) {
            $allpermissions[] = array('name' => $permission, 'guard_name' => 'web', 'created_at' => $nowtime, 'updated_at' => $nowtime);
            $count_permissions = $count_permissions + 1;
        }
        
        DB::table('permissions')->insert($allpermissions);
        
        for($i = 1; $i <= $count_permissions; $i++) {
            $allrolehaspermissions[] = array('permission_id' => $i, 'role_id' => 1);
        }
        DB::table('role_has_permissions')->insert($allrolehaspermissions);
    }
}
