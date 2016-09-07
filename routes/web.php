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

Route::group(['prefix' => 'users'],function(){
    Route::get('/posts',[
        'uses' => 'PostController@indexAll',
        'as' => 'user.posts',
        'redirect' => 'home',
        'acl' => 'UsersGuard@listPost'
    ]);

    Route::get('/',[
        'uses' => 'UserController@index',
        'as' => 'users.index',
        'redirect' => 'home',
        'acl' => 'UsersGuard@listUser'
    ]);

    Route::group(['prefix' => '{users}'],function(){
        Route::get('/',[
            'uses' => 'UserController@show',
            'as' => 'users.show'
        ]);

        Route::get('/edit',[
            'uses' => 'UserController@edit',
            'as' => 'users.edit',
            'acl' => 'UsersGuard@editUser'
        ]);

        Route::patch('/',[
            'uses' => 'UserController@update',
            'as' => 'users.update',
            'acl' => 'UsersGuard@editUser'
        ]);
    });
});

Auth::routes();

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);