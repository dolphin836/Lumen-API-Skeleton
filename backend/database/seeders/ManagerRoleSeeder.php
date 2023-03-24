<?php

namespace Database\Seeders;

use App\Models\ManagerRole;
use Illuminate\Database\Seeder;

class ManagerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 第一个角色为默认，不能删除
        $defaultManagerRoleList = ['超级管理员', '管理员', '销售经理', '客服', '财务'];

        foreach ($defaultManagerRoleList as $i => $roleName) {
            $role             = new ManagerRole();
            $role->name       = $roleName;
            $role->is_default = $i === 0;
            $role->state      = 0;
            $role->save();
        }
    }
}
