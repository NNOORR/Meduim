<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\ErrorsLog;

class BaseApiController extends Controller
{
    public const SUCCESS_CODE = 200;
    public const UNAUTHENTICATED = 401;

    public function output($value,$message,$code,$data)
    {
        return [
            'value'=>$value,
            'message'=>$message,
            'code'=>$code,
            'data'=>$data,
        ];
    }

    /**
     * @param \Throwable $e
     */
    public function exceptionOutput($e)
    {

        $eid = ErrorsLog::newError($e);

        return $this->output(false,'Operation Failed'.' '.$eid,$e->getCode(),[]);
    }

}