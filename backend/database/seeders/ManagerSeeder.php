<?php

namespace Database\Seeders;

use App\Models\Manager;
use App\Models\ManagerLinkRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 添加创始人记录
        $manager           = new Manager();
        $manager->team_id  = 1;
        $manager->username = 'Super Administrator';
        $manager->name     = env('CREATE_MANAGER_NAME');
        $manager->phone    = env('CREATE_MANAGER_PHONE');
        $manager->email    = env('CREATE_MANAGER_EMAIL');
        $manager->password = password_hash(env('CREATE_MANAGER_PASSWORD'), PASSWORD_DEFAULT);
        $manager->state    = 0;
        $manager->save();
        // 给创始人绑定角色
        $managerLinkRole                  = new ManagerLinkRole();
        $managerLinkRole->manager_id      = $manager->id;
        $managerLinkRole->manager_role_id = 1;
        $managerLinkRole->save();
    }
}
