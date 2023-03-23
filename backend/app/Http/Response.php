<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;

class Response
{
    /**
     * 返回
     *
     * @param array  $data    数据
     * @param int    $code    状态码
     * @param string $message 消息
     *
     * @return JsonResponse
     *
     * @author Wang HaiBing <wanghaibing836@gmail.com>
     * @date   2023/03/08 11:20
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
