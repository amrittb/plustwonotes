<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

Route::resource('posts','PostController');

Route::patch('/posts/{posts}/publish',['uses' => 'PostController@publish','as' => 'posts.publish']);
Route::patch('/posts/{posts}/draft',['uses' => 'PostController@draft','as' => 'posts.draft']);

Route::get('/users/posts',['uses' => 'PostController@indexAll','as' => 'user.posts']);

Route::resource('users','UserController');

Route::controllers([
    'auth' => 'AuthController'
]);

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);