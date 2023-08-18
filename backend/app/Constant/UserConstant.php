<?php

namespace App\Constant;

class UserConstant
{
    const USER_STATE_ACTIVE  = 1;
    const USER_STATE_LOCK    = 2;
    const USER_STATE_DELETED = 3;

    const USER_STATE_NAME_ENUM = [
         self::USER_STATE_ACTIVE => '活跃的',
           self::USER_STATE_LOCK => '已锁定',
        self::USER_STATE_DELETED => '已删除',
    ];
}