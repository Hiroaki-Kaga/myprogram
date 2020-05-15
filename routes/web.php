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

Route::get('/', 'PostsController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'PostsController@index');

Route::get('/users/edit', 'UsersController@edit');

Route::get('/users/{user_id}', 'UsersController@show');

Route::get('/posts/new', 'PostsController@new')->name('new');

Route::post('/posts','PostsController@store');

Route::post('/users/update', 'UsersController@update');

Route::get('/postsdelete/{post_id}', 'PostsController@destroy');


//いいね処理
Route::get('/posts/{post_id}/likes', 'LikesController@store');

//いいね取消処理
Route::get('/likes/{like_id}', 'LikesController@destroy');

// ==========ここから追加する==========
//コメント投稿処理
Route::post('/posts/{comment_id}/comments','CommentsController@store');

//コメント取消処理
Route::get('/comments/{comment_id}', 'CommentsController@destroy');
// ==========ここまで追加する==========
