<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 第一个部门为默认，不能删除
        $defaultTeamList = ['总经办', '研发部', '产品部', '财务', '销售部', '售后部'];

        foreach ($defaultTeamList as $i => $teamName) {
            $team             = new Team();
            $team->name       = $teamName;
            $team->is_default = $i === 0;
            $team->state      = 0;
            $team->save();
        }
    }
}
