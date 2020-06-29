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
                $articles = Article::where('name', 'like', '%' . $request->search_key . '%')->orderBy('preview_count', 'desc')->paginate(4);

            } else
                $articles = Article::orderBy('preview_count', 'desc')->paginate(4);

              return self::output(1, null, self::SUCCESS_CODE, $articles);
        }
        catch (\throwable $e)
        {
            return $this->exceptionOutput($e);
        }
    }


    /**
     * getArticle API
     * @param Request $request
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function getArticle(Request $request, $id)
    {

        try {
            $data = Article::find($id);
            $article = $data->toArray();
            if ($article) {
                //Update preview count ..
                $article['preview_count'] +=  1;
                Article::saveRecord($article, false);

                // fix attachments path
                $attachments = [];
                foreach ($data->attachments as $att) {
                    array_push($attachments, str_replace('public', '/storage', $att->path));
                }

                return self::output(1, null, self::SUCCESS_CODE, [
                    'article' => [
                        'title' => $data->title,
                        'brief' => $data->brief,
                        'description' => $data->description,
                        'created_at' => $data->created_at,
                        'preview_count' => $data->preview_count,
                        'author_name' => $data->author->name,
                    ],
                    'tags' => $data->tags,
                    'attachments' => $attachments,
                ]);
            }

            return self::output(0, null, 1000, null);
        } catch (\throwable $e) {
            return $this->exceptionOutput($e);
        }
    }

}
