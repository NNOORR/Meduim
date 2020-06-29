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
use App\Validators\NationalityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NationalitiesController extends BaseController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $nationalities = Nationality::getNationalities();
        $pagination = $nationalities->jsonSerialize();
        return view('pages.nationalities.index', compact('nationalities', 'pagination'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('pages.nationalities.create');

    }

    /**
     * @param Request $req
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|void
     */
    public function store(Request $req)
    {
        try {

            $data = $req->request->all();
            $errors = (new NationalityValidator())->validate($data);
            if (count($errors)) {
                $err = array();
                foreach ($errors->toArray() as $error) {
                    foreach ($error as $sub_error) {
                        array_push($err, $sub_error);
                    }
                }
                throw new UserException(implode(',', $err));
            }

            Nationality::saveRecord($data, true);

            Session::flash('flash_message', 'New nationality added Successfully');
            return redirect('admin/nationalities');

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
            $nationality = Nationality::find($id);
            if (is_null($nationality))
                Session::flash('error_message', 'Nationality not found!');

            $nationality->delete();
            Session::flash('flash_message', 'Nationality deleted successfully');

            return redirect('admin/nationalities');
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
            $nationality = Nationality::find($id);
            if (is_null($nationality))
                Session::flash('error_message', 'Nationality not found!');

            return view('pages.nationalities.create', compact('nationality'));

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

            $errors = (new NationalityValidator())->validate($data);
            if (count($errors)) {
                $err = array();
                foreach ($errors->toArray() as $error) {
                    foreach ($error as $sub_error) {
                        array_push($err, $sub_error);
                    }
                }
                throw new UserException(implode(',', $err));
            }

            // update nationality ..
            $nationality = Nationality::saveRecord($data, false);


            if ($nationality) {
                Session::flash('flash_message', 'Nationality updated Successfully');
                return redirect('admin/nationalities');
            }
        } catch (UserException $e) {
            return $this->output(false, $e->getMessage(), $e->getCode(), []);
        } catch (\Throwable $e) {
            return $this->exceptionOutput($e);
        }

    }

}
