<?php
// 管理员
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use Illuminate\Http\JsonResponse;

class ManagerController extends Controller
{
    public function signIn(): JsonResponse
    {
        return Response::success();
    }
}
