<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Exceptions\UserException;
use App\Models\Attachment;
use App\Models\Author;
use App\Models\Nationality;
use App\Models\Tag;
use App\Validators\ArticleValidator;
use App\Validators\AuthorValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthorsController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $authors = Author::getAuthors();
        $pagination = $authors->jsonSerialize();
        return view('pages.authors.index', compact('authors', 'pagination'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $nationalities = Nationality::all();
        return view('pages.authors.create', compact('nationalities'));

    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function store(Request $req)
    {
        try {

            $data = $req->request->all();
            $errors = (new AuthorValidator())->validate($data);
            if (count($errors)) {
                $err = array();
                foreach ($errors->toArray() as $error) {
                    foreach ($error as $sub_error) {
                        array_push($err, $sub_error);
                    }
                }
                throw new UserException(implode(',', $err));
            }

            Author::saveRecord($data, true);

            Session::flash('flash_message', 'New author added Successfully');
            return redirect('admin/authors');

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
            $author = Author::find($id);
            if (is_null($author))
                Session::flash('error_message', 'Author not found!');

            $author->delete();
            Session::flash('flash_message', 'Author deleted successfully');

            return redirect('admin/authors');
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
            $author = Author::find($id);
            $nationalities = Nationality::all();
            if (is_null($author))
                Session::flash('error_message', 'Author not found!');

            return view('pages.authors.create', compact('author', 'nationalities'));

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

            $errors = (new AuthorValidator())->validate($data);
            if (count($errors)) {
                $err = array();
                foreach ($errors->toArray() as $error) {
                    foreach ($error as $sub_error) {
                        array_push($err, $sub_error);
                    }
                }
                throw new UserException(implode(',', $err));
            }

            // update author ..
            $author = Author::saveRecord($data, false);


            if ($author) {
                Session::flash('flash_message', 'Author updated Successfully');
                return redirect('admin/authors');
            }
        } catch (UserException $e) {
            return $this->output(false, $e->getMessage(), $e->getCode(), []);
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }

    }

}
