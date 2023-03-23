<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */
    'default' => env('LOG_CHANNEL', 'stack'),
    /*
    |--------------------------------------------------------------------------
    | 日志通道配置
    |--------------------------------------------------------------------------
    |
    | 专门配置了一个 sql 通道，用于本地开发模式时记录 SQL
    |
    */
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily', 'sql']
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14
        ],
        'sql' => [
            'driver' => 'single',
            'path' => storage_path('logs/sql.log'),
            'level' => 'info'
        ]
    ]
];
