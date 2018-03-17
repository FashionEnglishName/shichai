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
Route::get("content","DefaultController@content");

Route::patch("users/{id}/edit-info",'UsersController@update_info')->name('edit-info');
Route::patch("users/{id}/edit-password",'UsersController@update_password')->name('edit-password');
Route::resource('users','UsersController');


Route::post("login","SessionsController@create")->name("login");
Route::delete("logout","SessionsController@destroy")->name("logout");
