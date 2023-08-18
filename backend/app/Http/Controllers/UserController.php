<?php

namespace App\Http\Controllers;

use App\Constant\DBConstant;
use App\Http\Request\GetUserPageListRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Response\UserListResponse;

class UserController extends Controller
{
    public function getUserPageList(GetUserPageListRequest $request): JsonResponse
    {
        $username  = $request->get('username');
        $name      = $request->get('name');
        $phone     = $request->get('phone');
        $email     = $request->get('email');
        $state     = (int) $request->get('state');
        $page      = (int) $request->get('page', 1);
        $pageCount = (int) $request->get('pageCount', DBConstant::QUERY_PAGE_COUNT);
        // 查询条件
        $where = [
            ['username', 'LIKE', $username],
            ['name', 'LIKE', $name],
            ['phone', '=', $phone],
            ['email', '=', $email],
            ['state', '=', $state]
        ];

        $userArr = User::getPageRows($where, [], $page, $pageCount);

        return UserListResponse::success($userArr);
    }
}
