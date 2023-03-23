<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Response;

class CommonException extends Exception
{
    /**
     * 未定义的异常码
     */
    private const UNKNOWN_EXCEPTION_CODE = 1000;

    /**
     * 未定义的异常消息
     */
    private const UNKNOWN_EXCEPTION_MESSAGE = '未定义的错误';

    /**
     * 模块编码：两位
     *
     * @var int
     */
    protected int $moduleCode = 10;

    /**
     * 异常编码：4 位
     */
    public int $exceptionCode;

    /**
     * 异常消息
     */
    public string $exceptionMessage;

    /**
     * 异常定义：异常码 4 位
     *
     * @var array
     */
    protected array $exception = [
        'NOT_FOUND'          => [1001, 'Http Exception Not Found'],
        'METHOD_NOT_ALLOWED' => [1002, 'Http Exception Method Not Allowed'],
        'PARAMETER_ERROR'    => [1003, '参数错误：%s'],
        'DB_ERROR'           => [1004, '数据库错误：%s'],
        'RABBITMQ_ERROR'     => [1005, 'RabbitMQ 错误：%s']
    ];

    /**
     * CommonException constructor.
     *
     * @param string $exceptionCode 异常码
     * @param array  $data          数据
     *
     * @author Wang HaiBing <wanghaibing836@gmail.com>
     * @date   2020/12/08 11:20
     */
    public function __construct(string $exceptionCode, array $data = [])
    {
        if (isset($this->exception[$exceptionCode])) {
            $exceptionContent = $this->exception[$exceptionCode];
            // 异常码
            $this->exceptionCode = $this->moduleCode . $exceptionContent[0];
            $this->exceptionCode = $this->moduleCode . $exceptionContent[0];
            // 异常消息
            if (empty($data)) {
                $this->exceptionMessage = $exceptionContent[1];
            } else {
                array_unshift($data, $exceptionContent[1]);

                $this->exceptionMessage = call_user_func_array('sprintf', $data);
            }
        } else {
            $this->exceptionCode    = $this->moduleCode . self::UNKNOWN_EXCEPTION_CODE;
            $this->exceptionMessage = self::UNKNOWN_EXCEPTION_MESSAGE;
        }
        // 上报异常
        parent::__construct($this->exceptionMessage, $this->exceptionCode);
    }

    /**
     * 输出异常
     */
    public function render(): JsonResponse
    {
        return Response::success([], $this->exceptionCode, $this->exceptionMessage);
    }
}
