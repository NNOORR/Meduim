<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Exceptions\UserException;
use App\Models\Attachment;
use App\Models\Author;
use App\Models\Tag;
use App\Validators\ArticleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $articles = Article::getArticles();
        return view('pages.articles.index', compact('articles'));
    }


    /**
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Article $article)
    {
        $authors = Author::all();
        return view('pages.articles.create', compact('authors'));

    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
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
                    $path = $img->store('public/uploads');
                    Attachment::saveRecord([
                        'article_id' => $article->id,
                        'path' => $path
                    ], true);
                }

                // Manipulate and Save Tags
                $tags = $data['tags'];
                $tags = explode(',', $tags);
                foreach ($tags as $tag){
                    Tag::saveRecord([
                        'article_id' => $article->id,
                        'name' => $tag
                    ], true);
                }

                Session::flash('flash_message', 'New article added Successfully');
            }

            $article = Article::find($article->id);
            return view('pages.articles.view', compact('article'));
        } catch (UserException $e) {
            return $this->output(false, $e->getMessage(), $e->getCode(), []);
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    function delete($id)
    {
        try {
            $article = Article::find($id);
            if (is_null($article))
                Session::flash('error_message', 'Article not found!');

            $article->delete();
            Session::flash('flash_message', 'Article deleted successfully');

            return redirect('admin/articles');
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    function edit($id)
    {
        try {
            $article = Article::find($id);
            $authors = Author::all();
            if (is_null($article))
                Session::flash('error_message', 'Article not found!');

            $tags= '';
            foreach ($article->tags as $key => $tag){
                if($key > 0)
                    $tags .= ',';
                $tags .= $tag->name;
            }
            return view('pages.articles.create', compact('article', 'authors', 'tags'));

        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }
    }

    /**
     * @param Request $req
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function update(Request $req, $id)
    {
        try {

            $data = $req->request->all();
            $data['id'] = $id;

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

            // update article ..
            $article = Article::saveRecord($data, false);


            if ($article) {
                // delete article's tags
                $article->tags()->delete();
                // delete article attachments
                $article->attachments()->delete();


                // Get uploaded images ..
                $imgs = $req->allFiles()['articleImgs'];
                foreach ($imgs as $img) {
                    $path = $img->store('public/uploads');
                    Attachment::saveRecord([
                        'article_id' => $id,
                        'path' => $path
                    ], true);
                }

                // Manipulate and Save Tags
                $tags = $data['tags'];
                $tags = explode(',', $tags);
                foreach ($tags as $tag){
                    Tag::saveRecord([
                        'article_id' => $id,
                        'name' => $tag
                    ], true);
                }

                Session::flash('flash_message', 'Article updated Successfully');
            }

            $article = Article::find($article->id);
            return view('pages.articles.view', compact('article'));
        } catch (UserException $e) {
            return $this->output(false, $e->getMessage(), $e->getCode(), []);
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function display($id)
    {
        // Get the article ..
        $article = Article::find($id);

        if(is_null($article)) {
            Session::flash('error_message', 'Article not found!');
            return redirect()->back();
        }

        return view('pages.articles.view', compact('article'));
    }

}
