<?php
// 管理员
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Manager Model Class
 *
 * @property int    team_id  部门 Id
 * @property string username 用户名
 * @property string name     姓名
 * @property string email    邮箱
 * @property string phone    手机
 * @property string password 密码
 * @property int    state    状态
 */
class Manager extends Model
{
    use HasFactory;

    protected $table = 'manager';
}
