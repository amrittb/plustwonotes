<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

Route::resource('posts','PostController');

Route::get('/user/posts',['uses' => 'PostController@indexAll','as' => 'user.posts']);

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);