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

Route::get("category","DefaultController@category")->name('category');
Route::get("user","DefaultController@user");
Route::get("content","DefaultController@content");

Route::get("home/{id}","UsersController@show");
Route::resource('users','UsersController');

Route::post("login","SessionsController@create")->name("login");
Route::delete("logout","SessionsController@destroy")->name("logout");
