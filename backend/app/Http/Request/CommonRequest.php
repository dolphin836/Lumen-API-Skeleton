<?php
// 规则参考文档：https://laravel.com/docs/10.x/validation#available-validation-rules
namespace App\Http\Request;

use App\Exceptions\CommonException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonRequest extends Request
{
    protected array $rules    = [];
    protected array $messages = [];

    /**
     * @throws CommonException
     */
    public function validate()
    {
        $validator = Validator::make($this->all(), $this->rules, $this->messages);

        if ($validator->fails()) {
            $errors = $validator->errors();

            foreach ($errors->toArray() as $error) {
                throw new CommonException('PARAMETER_ERROR', [$error[0]]);
            }
        }
    }

    public function setupRequest()
    {
        /** @var Request $request */
        $request = app('request');

        $this->initialize(
            $request->query(),
            $request->all(),
            $request->attributes->all(),
            [],
            $request->files->all(),
            $request->server->all(),
            $request->getContent()
        );
    }
}
