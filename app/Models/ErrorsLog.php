<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorsLog extends Model
{
    protected $table = 'errors_log';
    protected $fillable = ['message','file', 'line','trace','err_code'];

    static function getErrosLog(){
        return ErrorsLog::orderBy('id', 'desc')->paginate(4);
    }


    /**
     * @param \Throwable $e
     * @return int|mixed
     */
    public static function newError($e)
    {

        $model = new ErrorsLog();
        $model->message = $e->getMessage();
        $model->file = $e->getFile();
        $model->line = $e->getLine();
        $model->trace = $e->getTraceAsString();
        $model->err_code = $e->getCode();
        $model->save();
        return $model->id;
    }

}
