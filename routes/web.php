<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');


// Route::auth();

Auth::routes();

Route::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/post/{slug}', ['as'=>'blog.post', 'uses'=>'HomeController@post']);
Route::post('/post/comment', 'PostCommentsController@postComment');
Route::post('/create/user', 'AdminUserController@createUser');
Route::get('/userprofile/{id}', ['as'=>'user_profile', 'uses'=>'AdminUserController@userProfile']);
Route::post('/create/post', 'AdminPostsController@createPost');

Route::group(['middleware'=>'admin'], function(){

  Route::resource('/admin/users', 'AdminUserController', ['names'=>[
    'index'=>'admin.users.index',
    'create'=>'admin.users.create',
    'edit'=>'admin.users.edit'
  ]]);


  Route::resource('/admin/posts', 'AdminPostsController', ['names'=>[
    'index'=>'admin.posts.index',
    'create'=>'admin.posts.create',
    'edit'=>'admin.posts.edit'
  ]]);

  Route::resource('/admin/categories', 'AdminCategoriesController', ['names'=>[
    'index'=>'admin.categories.index',
    'create'=>'admin.categories.create',
    'edit'=>'admin.categories.edit'
  ]]);

  Route::resource('/admin/media', 'AdminMediaController', ['names'=>[
    'index'=>'admin.media.index',
    'create'=>'admin.media.create'
  ]]);

  // Route::delete('/delete/multimedia', 'AdminMediaController@deleteMedia');
  Route::delete('/admin/delete/multimedia', ['as'=>'delete.media', 'uses'=>'AdminMediaController@deleteMedia']);

  Route::resource('/admin/comments', 'PostCommentsController', ['names'=>[
    'index'=>'admin.comments.index',
    'show'=>'admin.comments.show'
  ]]);

  Route::resource('/admin/comment/replies', 'CommentRepliesController', ['names'=>[
      'show'=>'admin.comment.replies.show'
  ]]);

  Route::get('/admin', ['as'=>'admin.index', 'uses'=>'AdminController@index']);
});


Route::group(['middleware'=>'auth'], function(){
  Route::post('/comment/reply', 'CommentRepliesController@createReply');
});
