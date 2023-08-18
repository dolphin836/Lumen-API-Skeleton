<?php

namespace App\Http\Request;

class GetUserPageListRequest extends CommonRequest
{
    protected array $rules = [
         'username' => ['nullable', 'string', 'max:64'],
             'name' => ['nullable', 'string', 'max:64'],
            'phone' => ['nullable', 'string', 'max:32'],
            'email' => ['nullable', 'string', 'max:256'],
            'state' => ['nullable', 'numeric'],
             'page' => ['nullable', 'numeric', 'min:1'],
        'pageCount' => ['nullable', 'numeric', 'min:1', 'max:100']
    ];

    protected array $messages = [
          'username.string' => 'username 必须是字符串',
              'name.string' => 'name 必须是字符串',
             'phone.string' => 'phone 必须是字符串',
             'email.string' => 'email 必须是字符串',
             'username.max' => 'username 不得大于 64',
                 'name.max' => 'name 不得大于 64',
                'phone.max' => 'phone 不得大于 32',
                'email.max' => 'email 不得大于 256',
            'state.numeric' => 'state 必须是数字',
             'page.numeric' => 'page 必须是数字',
        'pageCount.numeric' => 'pageCount 必须是数字',
                 'page.min' => 'page 不得小于 1',
            'pageCount.min' => 'pageCount 不得小于 1',
            'pageCount.max' => 'pageCount 不得大于 100',
    ];
}
