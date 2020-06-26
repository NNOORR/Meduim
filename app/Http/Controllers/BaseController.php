<?php

namespace App\Http\Controllers;

use App\Models\ErrorsLog;
use Illuminate\Support\Facades\Session;

//use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    public const SUCCESS_CODE = 200;
    public const UNAUTHENTICATED = 401;

    public function output($value,$message,$code,$data)
    {
         Session::flash('error_message', $message);
    }

    /**
     * @param \Throwable $e
     */
    public function exceptionOutput($e)
    {

        $eid = ErrorsLog::newError($e);

        Session::flash('error_message', 'Unexpected error!');

        return redirect()->back();
    }

    public function unauthorizedOutput(){
        return response()->json(
            [
                'value' => false,
                'message' => 'User not unauthorized',
                'code' => 401,
                'data' => [],
            ], 401);
    }
}