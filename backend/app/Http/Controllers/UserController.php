<?php

namespace App\Http\Controllers;

use App\Http\Request\UserSignInRequest;
use App\Http\Response;
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

    /**
     * 注册
     */
    public function signUp(UserLoginRequest $request): JsonResponse
    {
        $name = $request->get('name');
    
        // TODO: Implement login logic
    
        return Response::success();
    }
}
