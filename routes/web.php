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

Route::get("/","DefaultController@login")->name("login");
Route::get("home","DefaultController@home");
Route::get("category","DefaultController@category");
Route::get("user","DefaultController@user");
Route::get("content","DefaultController@content");


Route::resource('users','UsersController');

Route::post("users/login","UsersController@store");

