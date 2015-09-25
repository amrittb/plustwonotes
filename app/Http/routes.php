<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

Route::resource('posts','PostController');

Route::get('/{category}',['uses' => 'PostController@index','as' => 'posts.index.category']);