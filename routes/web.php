<?php

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
//home
Route::get('/home', 'HomeController@index')->name('home');
Route::get('home', 'Admin\HomeController@index');

//purchase
Route::get('/purchase', 'PurchaseController@index')->name('home');
Route::get('/purchase/create-new', 'PurchaseController@create_page')->name('home');
Route::post('/purchase/create-new', 'PurchaseController@save_create')->name('home');
Route::get('/purchase/update/{purchase}', 'PurchaseController@update_page')->name('home');
Route::post('/purchase/update/{purchase}', 'PurchaseController@update_save')->name('home');
Route::delete('/purchase/delete/{purchase}', 'PurchaseController@delete')->name('home');

//purhcase report
Route::get('/purchase/show', 'PurchaseController@show')->name('home');
Route::get('/purchase/excel', 'PurchaseController@excel')->name('home');


Route::group(['middleware' => 'admin'], function () {
    //users
    Route::get('master/user', 'Admin\UsersController@index');
    Route::get('master/user/create-new', 'Admin\UsersController@create_page');
    Route::post('master/user/create-new', 'Admin\UsersController@create_save');
    Route::get('master/user/update/{user}', 'Admin\UsersController@update_page');
    Route::post('master/user/update/{user}', 'Admin\UsersController@update_save');

    //product
    Route::get('master/product', 'Admin\ProductController@index');
    Route::get('master/product/create-new', 'Admin\ProductController@create_page');
    Route::post('master/product/create-new', 'Admin\ProductController@save_create');
    Route::get('master/product/update/{product}', 'Admin\ProductController@update_page');
    Route::post('master/product/update/{product}', 'Admin\ProductController@save_update');
    Route::delete('master/product/delete/{product}', 'Admin\ProductController@delete');

    //report
    Route::get('report', 'ReportController@index');
    Route::get('report/excel', 'ReportController@excel');

    //Artikel
    // Route::get('admin/artikel', 'Admin\ArtikelsController@index');
    // Route::get('admin/artikel/create-new', 'Admin\ArtikelsController@create_page');
    // Route::post('admin/artikel/create-new', 'Admin\ArtikelsController@create_save');
    // Route::get('admin/artikel/update/{quotes}', 'Admin\ArtikelsController@update_page');
    // Route::post('admin/artikel/update/{quotes}', 'Admin\ArtikelsController@update_save');
    // Route::delete('admin/artikel/', 'Admin\ArtikelsController@delete');
    // //master tags
    // Route::get('admin/master/tags', 'Admin\TagsController@index');
    // Route::get('admin/master/tags/create-new', 'Admin\TagsController@create_page');
    // Route::post('admin/master/tags/create-new', 'Admin\TagsController@save_page');
    // Route::get('admin/master/tags/update/{tag}', 'Admin\TagsController@update_page');
    // Route::post('admin/master/tags/update/{tag}', 'Admin\TagsController@update_save');
    // Route::delete('admin/master/tags/delete/{tag}', 'Admin\TagsController@delete');
    // //master universities
    // Route::get('admin/master/universities', 'Admin\UniversitiesController@index');
    // Route::get('admin/master/universities/create-new', 'Admin\UniversitiesController@create_page');
    // Route::post('admin/master/universities/create-new', 'Admin\UniversitiesController@save_page');
    // Route::get('admin/master/universities/update/{unive}', 'Admin\UniversitiesController@update_page');
    // Route::post('admin/master/universities/update/{unive}', 'Admin\UniversitiesController@update_save');
    // Route::delete('admin/master/universities/delete', 'Admin\UniversitiesController@delete');
    //
    // //faculties
    // Route::get('admin/master/faculties', 'Admin\FacultiesController@index');
    // Route::get('admin/master/faculties/create-new', 'Admin\FacultiesController@create_page');

});
