<?php
// Cache 服务类，理论上不允许直接使用 Laravel 的 Cache Facade 或者 cache() 方法操作缓存
// 对 Cache 的所有操作都必须使用该类
namespace App\Http\Service;

class CacheService extends Service
{

}