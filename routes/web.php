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
Route::patch('users/{id}/edit-avatar', 'UsersController@update_avatar')->name('users.edit_avatar');
Route::resource('users','UsersController');
Route::post("users/{id}/location", "UsersController@get_cities")->name('location');


Route::post("login","SessionsController@create")->name("login");
Route::delete("logout","SessionsController@destroy")->name("logout");

Route::get("articles/create", "ArticlesController@create")->name('articles.create');
Route::post("articles/store", "ArticlesController@store")->name('articles.store');
Route::get("articles/{id}/edit", "ArticlesController@edit")->name('articles.edit');
Route::patch("articles/{id}", "ArticlesController@update")->name('articles.update');
Route::get("articles/{id}", "ArticlesController@show")->name('articles.show');
Route::delete("articles/{id}", "ArticlesController@destroy")->name('articles.destroy');
Route::post("upload_image", "ArticlesController@uploadImage")->name('articles.upload_image');
Route::post("upload_cover", "ArticlesController@uploadCover")->name('articles.upload_cover');

Route::post('articles/{id}/collect', "CollectionsController@store")->name('collections.store');
Route::delete('articles{id}/collect', 'CollectionsController@destroy')->name('collections.destroy');
Route::get('articles/collect/index', "DefaultController@my_collect")->name('collect');

Route::post('articles/{id}/purchase', 'PurchasesController@store')->name('purchases.store');
Route::post('articles/{id}/ignite', 'PurchasesController@ignite')->name('purchases.ignite');
Route::get('purchased', 'DefaultController@my_purchased')->name('my_purchased');
Route::delete('purchased/{id}/refund', 'PurchasesController@destroy')->name('purchases.destroy');


Route::get('tutorials/index', 'TutorialsController@index')->name('tutorials.index');
Route::get('tutorials/finished', 'TutorialsController@finished')->name('tutorials.finished');
Route::get('tutorials/waiting', 'TutorialsController@waiting')->name('tutorials.waiting');
Route::get('tutorials/unfired', 'TutorialsController@unfired')->name('tutorials.unfired');
Route::get('tutorials/{work_id}/create', 'TutorialsController@create')->name('tutorials.create');
Route::post('tutorials/{work_id}/store', 'TutorialsController@store')->name('tutorials.store');
Route::get('tutorials/{tutorial_id}/edit', 'TutorialsController@edit')->name('tutorials.edit');
Route::patch('tutorials/{tutorial_id}/update', 'TutorialsController@update')->name('tutorials.update');


Route::get("/users/{id}/followings", "UsersController@show_followings")->name('users.show_followings');
Route::get("/users/{id}/followers", "UsersController@show_followers")->name('users.show_followers');

Route::post('/users/follow/{id}', "FollowersController@store")->name('followers.store');
Route::delete('/users/follow/{id}', "FollowersController@destroy")->name('followers.destroy');
Route::get('follow/list', "FollowersController@followings_list")->name('followings.list');

Route::get('follow', "DefaultController@my_follow")->name('follow');

Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
Route::delete('notifications/clear', 'NotificationsController@clear')->name('notifications.clear');

Route::get('test/cropper', 'DefaultController@cropper')->name('test.cropper');
Route::post('test/upload', 'DefaultController@upload')->name('test.upload');