<?php

namespace App\Models;

use App\Constant\DBConstant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Model 基类
 *
 * @property integer id         主键
 * @property Carbon  created_at 创建时间
 * @property Carbon  updated_at 更新时间
 */
class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * 根据主键 Id 查询单条记录
     *
     * @param int $id
     */
    public static function find(int $id)
    {
        return self::query()->find($id);
    }

    /**
     * 应用查询条件并返回查询构造器
     *
     * @param array $where
     *
     * @return Builder
     */
    public static function getQuery(array $where = []): Builder
    {
        $query = self::query();

        if (! empty($where)) {
            foreach ($where as $i => $item) {
                // 非法格式
                if (count($item) !== 3) {
                    continue;
                }

                $column   = $item[0]; // 字段
                $operator = strtoupper($item[1]); // 条件
                $value    = $item[2]; // 值
                // 空值、不允许的查询条件
                if (empty($value) || in_array($operator, DBConstant::QUERY_CONDITION_ENUM)) {
                    continue;
                }
                // IN 和 NOT IN 是 Value 必须是数组
                if (($operator === 'IN' || $operator === 'NOT IN') && ! is_array($value)) {
                    continue;
                }
                // 开始应用条件
                if ($operator === 'IN') {
                    $query->whereIn($column, $value);

                    continue;
                }

                if ($operator === 'NOT IN') {
                    $query->whereNotIn($column, $value);

                    continue;
                }
                // LIKE
                if ($operator === 'LIKE') {
                    $where[$i][2] = '%' . $item[2] . '%';
                }

                $query->where($item);
            }
        }

        return $query;
    }

    /**
     * 执行排序条件
     *
     * @param Builder $query        Builder
     * @param array   $orderColumns 排序条件
     *
     * @return Builder
     */
    private static function runOrderColumns(Builder $query, array $orderColumns = []): Builder
    {
        // 应用默认的排序条件
        if (empty($orderColumns)) {
            $orderColumns = DBConstant::QUERY_DEFAULT_ORDER_COLUMN;
        }

        foreach ($orderColumns as $orderColumn => $direction) {
            $query->orderBy($orderColumn, $direction);
        }

        return $query;
    }

    /**
     * 根据某个字段查询单条记录
     *
     * @param string $column 字段
     * @param mixed  $value  值
     *
     * @return array
     */
    public static function getRowByColumn(string $column, mixed $value): array
    {
        $query = self::query()->where($column, $value);
        // 查询数据
        $data  = $query->first();

        return empty($data) ? [] : $data->toArray();
    }

    /**
     * 根据自定义条件查询单条记录
     *
     * @param array  $where        查询条件
     * @param array  $orderColumns 排序条件
     *
     * @return array
     */
    public static function getRow(array $where = [], array $orderColumns = []): array
    {
        // 应用查询条件
        $query = self::getQuery($where);
        // 应用排序
        $row   = self::runOrderColumns($query, $orderColumns)->first();

        return empty($row) ? [] : $row->toArray();
    }

    /**
     * 根据自定义条件查询多条记录
     *
     * @param array  $where        查询条件
     * @param array  $orderColumns 排序条件
     * @param int    $limit        数量限制
     *
     * @return array
     */
    public static function getRows(array $where = [], array $orderColumns = [], int $limit = 0): array
    {
        // 应用查询条件
        $query = self::getQuery($where);
        // 应用数量限制
        if ($limit) {
            $query->limit($limit);
        }
        // 应用排序
        return self::runOrderColumns($query, $orderColumns)
                   ->get()
                   ->toArray();
    }

    /**
     * 根据自定义条件查询分页记录
     *
     * @param array  $where        查询条件
     * @param array  $orderColumns 排序条件
     * @param int    $page         页数
     * @param int    $pageCount    数量
     *
     * @return array
     */
    public static function getPageRows(array $where = [], array $orderColumns = [], int $page = 1, int $pageCount = DBConstant::QUERY_PAGE_COUNT): array
    {
        // 应用查询条件
        $query = self::getQuery($where);
        // 应用分页
        $query->offset(($page - 1) * $pageCount)->limit($pageCount);
        // 应用排序
        return self::runOrderColumns($query, $orderColumns)
                   ->get()
                   ->toArray();
    }
}
