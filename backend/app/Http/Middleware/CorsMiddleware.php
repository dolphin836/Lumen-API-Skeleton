<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class CorsMiddleware
{
    /**
     * 跨域请求处理中间件
     *
     * @param Request $request Http 请求
     * @param Closure $next    Closure
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = [
              'Access-Control-Allow-Origin' => '*',
            'Access-Control-Request-Method' => 'POST, GET, OPTIONS, PUT, DELETE',
             'Access-Control-Allow-Headers' => 'Content-Type, Token'
        ];
        // 非跨域请求，直接放行
        if (! $this->isCors($request)) {
            return $next($request);
        }
        // 前置检查请求
        if ($this->isPreflight($request)) {
            return response()->json('{"method": "OPTIONS"}', 200, $headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }

    /**
     * 判断请求是否为 CORS 请求
     *
     * @param Request $request Http 请求
     *
     * @return bool
     */
    private function isCors(Request $request): bool
    {
        return $request->headers->has('Origin');
    }

    /**
     * 判断请求是否为 Preflight 请求
     *
     * @param Request $request Http 请求
     *
     * @return bool
     */
    private function isPreflight(Request $request): bool
    {
        return $this->isCors($request) && $request->isMethod('OPTIONS') && $request->headers->has('Access-Control-Request-Method');
    }
}
