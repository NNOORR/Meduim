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
Route::get('/{any}', 'SpaController@index')->where('any', '.*');