<?php
// 管理员 - 角色
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * ManagerLinkRole Model Class
 *
 * @property int manager_id       管理员 Id
 * @property int manager_role_id  管理员角色 Id
 */
class ManagerLinkRole extends Model
{
    use HasFactory;

    protected $table = 'manager_link_role';
}
