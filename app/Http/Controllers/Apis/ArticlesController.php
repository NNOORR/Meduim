<?php

namespace App\Http\Controllers\Apis;

use App\Models\Article;
use Illuminate\Http\Request;


class ArticlesController extends BaseApiController
{

    /**
     * getArticles API
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function getArticles(Request $request){

        try {
            if (isset($request->search_key) and !empty($request->search_key)) {
                $articles = Article::where('name', 'like', '%' . $request->search_key . '%')->orderBy('id', 'desc')->paginate(4);

            } else
                $articles = Article::orderBy('id', 'desc')->paginate(4);

              return self::output(1, null, self::SUCCESS_CODE, $articles);
        }
        catch (\throwable $e)
        {
            return $this->exceptionOutput($e);
        }
    }
}
