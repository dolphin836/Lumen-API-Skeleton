<?php

namespace App\Constant;

class DBConstant
{
    // 允许使用的查询条件
    const QUERY_CONDITION_ENUM = ['=', 'LIKE', 'IN', 'NOT IN'];
    // 分页查询的默认数量
    const QUERY_PAGE_COUNT = 20;
    // 默认的排序条件
    const QUERY_DEFAULT_ORDER_COLUMN = ['id' => 'DESC'];
}