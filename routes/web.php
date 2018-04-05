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

Route::get("/","DefaultController@home")->name('home');

Route::get("category/{id}","DefaultController@category")->name('category');
Route::get("content","DefaultController@content");


Route::post('users/{id}/add_firewood', 'UsersController@add_firewood')->name('users.add_firewood');
Route::get('users/{id}/check_firewood', 'UsersController@check_firewood')->name('users.check_firewood');
Route::patch("users/{id}/edit-info",'UsersController@update_info')->name('edit-info');
Route::patch("users/{id}/edit-password",'UsersController@update_password')->name('edit-password');
Route::resource('users','UsersController');
Route::post("users/{id}/location", "UsersController@get_cities")->name('location');


Route::post("login","SessionsController@create")->name("login");
Route::delete("logout","SessionsController@destroy")->name("logout");

Route::get("articles/create", "ArticlesController@create")->name('articles.create');
Route::post("articles/store", "ArticlesController@store")->name('articles.store');
Route::get("articles/{id}/edit", "ArticlesController@edit")->name('articles.edit');
Route::patch("articles/{id}", "ArticlesController@update")->name('articles.update');



