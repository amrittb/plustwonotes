<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

Route::get('search',['uses' => 'HomeController@search','as' => 'search']);

Route::get('/posts/trashed',[
    'uses' => 'PostController@trashed',
    'as' => 'posts.trashed',
]);

Route::patch('/posts/{posts}/restore',[
    'uses' => 'PostController@restore',
    'as' => 'posts.restore',
]);

Route::patch('/posts/{posts}/publish', [
    'uses' => 'PostController@publish',
    'as' => 'posts.publish',
]);

Route::patch('/posts/{posts}/unpublish', [
    'uses' => 'PostController@unpublish',
    'as' => 'posts.unpublish',
]);

Route::patch('/posts/{posts}/draft', [
    'uses' => 'PostController@draft',
    'as' => 'posts.draft',
]);

Route::patch('/posts/{posts}/contentready',[
    'uses' => 'PostController@contentready',
    'as' => 'posts.contentready',
]);

Route::resource('posts','PostController');

Route::get('/posts/grade/{grade}',[
    'uses' => 'PostController@indexByGrade',
    'as' => 'posts.index.grade'
]);

Route::get('/posts/grade/{grade}/subject/{subject}',[
    'uses' => 'PostController@indexBySubject',
    'as' => 'posts.index.subject'
]);

Route::get('/users/posts',[
    'uses' => 'PostController@indexAll',
    'as' => 'user.posts'
]);

Route::resource('users','UserController',['only' => ['index','edit','update']]);

Route::get('@{users}', [
    'as' => 'users.show',
    'uses' => 'UserController@show'
]);

Auth::routes();

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);