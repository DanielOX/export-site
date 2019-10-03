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

Route::get('/','WelcomeController@index')->name('welcome.home');
Route::post('/','WelcomeController@search')->name('welcome.search');
Route::get('/search/{id}/{type}','WelcomeController@search_query')->name('welcome.search.get');
Auth::routes();
Route::get('/home','HomeController@index')->name('home.controller');

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    /* Admin Products Routes */
    Route::get('/products','ProductsController@index')->name('products.browse');
    Route::get('/products/create','ProductsController@create')->name('products.create');
    Route::post('/products/store','ProductsController@store')->name('products.store');
    Route::get('/products/delete','ProductsController@destroy')->name('products.delete');
    Route::get('/products/edit','ProductsController@edit')->name('products.edit');
    Route::post('/products/update','ProductsController@update')->name('products.update');



    /* Admin Cateogry Routes */
    Route::get('/category','CategoryController@index')->name('category.browse');
    Route::get('/category/create','CategoryController@create')->name('category.create');
    Route::post('/category/store','CategoryController@store')->name('category.store');
    Route::get('/category/delete','CategoryController@destroy')->name('category.delete');
    Route::get('/category/edit','CategoryController@edit')->name('category.edit');
    Route::post('/category/update','CategoryController@update')->name('category.update');


    /* Admin Packages Routes */
    Route::get('/package','PackageController@index')->name('package.browse');
    Route::get('/package/create','PackageController@create')->name('package.create');
    Route::post('/package/store','PackageController@store')->name('package.store');
    Route::get('/package/delete','PackageController@destroy')->name('package.delete');
    Route::get('/package/edit','PackageController@edit')->name('package.edit');
    Route::post('/package/update','PackageController@update')->name('package.update');
    Route::get('/package/show','PackageController@show')->name('package.show');



    /* Admin General Productts Routes */
    Route::get('/generalproducts','GeneralProductsController@index')->name('generalproducts.browse');
    Route::get('/generalproducts/create','GeneralProductsController@create')->name('generalproducts.create');
    Route::post('/generalproducts/store','GeneralProductsController@store')->name('generalproducts.store');
    Route::get('/generalproducts/delete','GeneralProductsController@destroy')->name('generalproducts.delete');
    Route::get('/generalproducts/edit','GeneralProductsController@edit')->name('generalproducts.edit');
    Route::post('/generalproducts/update','GeneralProductsController@update')->name('generalproducts.update');
    Route::get("/generalproducts/show",'GeneralProductsController@show')->name('generalproducts.show');


});
