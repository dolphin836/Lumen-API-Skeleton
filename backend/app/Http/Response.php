<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class Response
{
    /**
     * 返回成功
     *
     * @param array  $data    数据
     * @param int    $code    状态码
     * @param string $message 消息
     */
    public static function success(array $data = [], int $code = 0, string $message = ''): JsonResponse
    {
        $content = [
               'code' => $code,
            'message' => $message,
               'data' => $data
        ];

        return response()->json($content);
    }

    /**
     * 返回错误
     *
     * @param int    $code      状态码
     * @param string $message   消息
     * @param int    $stateCode Http 状态码
     */
    public static function error(int $code = 0, string $message = '', int $stateCode = 200): JsonResponse
    {
        $content = [
               'code' => $code,
            'message' => $message,
               'data' => []
        ];

        return response()->json($content, $stateCode);
    }
}
