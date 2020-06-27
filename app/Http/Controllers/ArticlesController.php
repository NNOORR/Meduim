<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Exceptions\UserException;
use App\Models\Attachment;
use App\Models\Author;
use App\Validators\ArticleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticlesController extends BaseController
{
    function index()
    {
        $articles = Article::getArticles();
        return view('pages.articles.index', compact('articles'));
    }


    public function create(Article $article)
    {
        $authors = Author::all();
        return view('pages.articles.create', compact('authors'));

    }

    public function store(Request $req)
    {
        try {


            $data = $req->request->all();
            $errors = (new ArticleValidator())->validate($data);
            if (count($errors)) {
                $err = array();
                foreach ($errors->toArray() as $error) {
                    foreach ($error as $sub_error) {
                        array_push($err, $sub_error);
                    }
                }
                throw new UserException(implode(',', $err));
            }

            $article = Article::saveRecord($data, true);


            if ($article) {
                // Get uploaded images ..
                $imgs = $req->allFiles()['articleImgs'];
                foreach ($imgs as $img) {
                    $path = $img->store('uploads');
                    Attachment::saveRecord([
                        'article_id' => $article->id,
                        'path' => $path
                    ], true);
                }

                // Manipulate and Save Tags
                $tags = $data['tags'];


                Session::flash('flash_message', 'New article added Successfully');
            }

            $articles = Article::getArticles();
            return view('pages.articles.index', compact('articles'));
        } catch (UserException $e) {
            return $this->output(false, $e->getMessage(), $e->getCode(), []);
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }

    }


    function delete($id)
    {
        try {
            $article = Article::find($id);
            if (is_null($article))
                Session::flash('error_message', 'Article not found!');

            $article->delete();
            Session::flash('flash_message', 'Article deleted successfully');

            $articles = Article::getArticles();
            return view('pages.articles.index', compact('articles'));
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }
    }


    function edit($id)
    {
        try {
            $article = Article::find($id);
            $authors = Author::all();
            if (is_null($article))
                Session::flash('error_message', 'Article not found!');

            return view('pages.articles.create', compact('article', 'authors'));

        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }
    }


    function update($id)
    {
        try {
            $article = Article::find($id);
            if (is_null($article))
                Session::flash('error_message', 'Article not found!');

            Article::saveRecord($article, false);
            Session::flash('flash_message', 'Article deleted successfully');

            $articles = Article::getArticles();
            return view('pages.articles.index', compact('articles'));
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }
    }

}
