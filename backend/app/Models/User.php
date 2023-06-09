<?php
// 用户
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * User Model Class
 *
 * @property string username 用户名
 * @property string name     姓名
 * @property string email    邮箱
 * @property string phone    手机
 * @property string password 密码
 * @property int    state    状态
 */
class User extends Model
{
    use HasFactory;

    protected $table = 'user';
}
