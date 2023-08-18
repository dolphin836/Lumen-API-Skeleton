<?php

namespace App\Http\Response;

use App\Constant\UserConstant;
use App\Http\Response;
use Illuminate\Http\JsonResponse;

class UserListResponse extends Response {

    public static function success(array $data = [], int $code = 0, string $message = ''): JsonResponse
    {
        $response = [];

        foreach ($data as $user) {
            $response[] = [
                        'id' => $user['id'],
                  'username' => $user['username'],
                      'name' => $user['name'],
                     'email' => $user['email'],
                     'phone' => $user['phone'],
                     'state' => $user['state'],
                'state_name' => UserConstant::USER_STATE_NAME_ENUM[$user['state']] ?? '未知',
                'created_at' => strtotime($user['created_at']),
                'updated_at' => strtotime($user['updated_at'])
            ];
        }

        return parent::success($response, $code, $message);
    }
}
