<?php

namespace App\Providers;

use App\Http\Request\CommonRequest;
use Illuminate\Support\ServiceProvider;

class RequestValidatorProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->afterResolving(CommonRequest::class, function (CommonRequest $request, $app) {
            $request->setupRequest();
            $request->validate();
        });
    }
}
