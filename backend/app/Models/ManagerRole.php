<?php
// 管理员角色
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ManagerRole Model Class
 *
 * @property string name       名称
 * @property int    is_default 是否默认
 * @property int    state      状态
 */
class ManagerRole extends Model
{
    use HasFactory;

    protected $table = 'manager_role';
}
