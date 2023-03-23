<?php
// 本地开发模式时记录 SQL
namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryListener
{
    public function __construct()
    {

    }

    /**
     * @param QueryExecuted $event
     */
    public function handle(QueryExecuted $event)
    {
        // 非本地环境直接返回
        if (env("APP_ENV") !== "local") {
            return;
        }

        if ($event->sql) {
            $sql      = $event->sql;
            $bindings = $event->bindings;
            $count    = count($bindings);

            while ($count > 0) {
                $count--;
                $sql = preg_replace('/\?/', array_shift($bindings), $sql, 1);
            }

            Log::channel('sql')->info($sql);
        }
    }
}
