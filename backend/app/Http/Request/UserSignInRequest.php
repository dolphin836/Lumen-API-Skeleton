<?php

namespace App\Http\Request;

class UserSignInRequest extends CommonRequest
{
    protected array $rules = [
        'name' => ['required', 'max:4'],
        'code' => ['required']
    ];

    protected array $messages = [
        'name.required' => 'name 是必须的'
    ];
}
