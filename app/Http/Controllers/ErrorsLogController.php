<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Exceptions\UserException;
use App\Models\Attachment;
use App\Models\Author;
use App\Models\ErrorsLog;
use App\Models\Nationality;
use App\Models\Tag;
use App\Validators\ArticleValidator;
use App\Validators\AuthorValidator;
use App\Validators\NationalityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ErrorsLogController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $errorsLog = ErrorsLog::getErrosLog();
        return view('pages.errors-log.index', compact('errorsLog'));
    }

}
