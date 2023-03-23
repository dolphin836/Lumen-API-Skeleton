<?php

namespace App\Models;

use Carbon\Carbon;

/**
 * Model 基类
 *
 * @property integer id         主键
 * @property Carbon  created_at 创建时间
 * @property Carbon  updated_at 更新时间
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    public static function find(int $id)
    {
        return self::query()->find($id);
    }

    /**
     * 根据自定义条件查询多条记录
     *
     * @param array  $where       查询条件
     * @param string $orderColumn 排序的 KEY
     * @param string $direction   排序方式
     * @param int    $limit       数量限制
     *
     * @return array
     */
    public static function getRows(array $where = [], string $orderColumn = 'id', string $direction = 'DESC', int $limit = 0): array
    {
        $query = self::query()->where($where)->orderBy($orderColumn, $direction);
        // 数量限制
        if ($limit) {
            $query->limit($limit);
        }
        // 查询数据
        return $query->get()->toArray();
    }
}
