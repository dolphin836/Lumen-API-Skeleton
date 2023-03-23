<?php

namespace App\Http\Controllers;

use App\Http\Request\UserSignInRequest;
use App\Http\Response;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * 登录
     */
    public function signIn(UserSignInRequest $request): JsonResponse
    {
        $name = $request->get('name');

        return Response::success();
    }

    public function getList(): JsonResponse
    {
        $where = [
            ['id', '<', '50']
        ];

        $userArr = User::getRows($where);

        return Response::success($userArr);
    }
}
