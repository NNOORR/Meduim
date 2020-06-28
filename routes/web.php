<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    return view('pages.master-page');
});


Route::get('admin/articles', 'ArticlesController@index');
Route::get('admin/articles/create', 'ArticlesController@create');
Route::post('admin/articles/store', 'ArticlesController@store');
Route::get('admin/articles/delete/{id}', 'ArticlesController@delete');
Route::get('admin/articles/edit/{id}', 'ArticlesController@edit');
Route::post('admin/articles/update/{id}', 'ArticlesController@update');
Route::get('admin/articles/view/{id}', 'ArticlesController@display');





Route::group(['prefix' => '/admin/authors'], function () {

    Route::get('', 'AuthorsController@index');
    Route::get('create', 'AuthorsController@create');
    Route::post('store', 'AuthorsController@store');
    Route::get('delete/{id}', 'AuthorsController@delete');
    Route::get('edit/{id}', 'AuthorsController@edit');
    Route::post('update/{id}', 'AuthorsController@update');
});

Route::group(['prefix' => '/admin/nationalities'], function () {

    Route::get('', 'NationalitiesController@index');
    Route::get('create', 'NationalitiesController@create');
    Route::post('store', 'NationalitiesController@store');
    Route::get('delete/{id}', 'NationalitiesController@delete');
    Route::get('edit/{id}', 'NationalitiesController@edit');
    Route::post('update/{id}', 'NationalitiesController@update');
});

Route::get('admin/errors-log', 'ErrorsLogController@index');





Route::get('/{any}', 'SpaController@index')->where('any', '.*');


