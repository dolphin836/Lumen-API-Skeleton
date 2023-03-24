<?php
// 部门
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Team Model Class
 *
 * @property string name       名称
 * @property int    is_default 是否默认
 * @property int    state      状态
 */
class Team extends Model
{
    use HasFactory;

    protected $table = 'team';
}
