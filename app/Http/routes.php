<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

//  /posts group
Route::group(['prefix' => 'posts'], function(){
    Route::get('/',[
        'uses' => 'PostController@index',
        'as' => 'posts.index'
    ]);

    Route::get('/create',[
        'uses' => 'PostController@create',
        'as' => 'posts.create',
        'acl' => [
            'User:hasPermission:post.create'
        ]
    ]);

    Route::post('/',[
        'uses' => 'PostController@store',
        'as' => 'posts.store',
        'acl' => [
            'User:hasPermission:post.create'
        ]
    ]);

    Route::get('/trashed',[
        'uses' => 'PostController@trashed',
        'as' => 'posts.trashed',
        'acl' => [
            'User:hasPermission:post.destroy'
        ]
    ]);

    //  /posts/{posts} group
    Route::group(['prefix' => '{posts}','redirect' => 'user.posts'],function(){
        Route::get('/',[
            'uses' => 'PostController@show',
            'as' => 'posts.show'
        ]);

        Route::get('/edit',[
            'uses' => 'PostController@edit',
            'as' => 'posts.edit',
            'acl' => [
                'User:hasPermission:post.update',
                'posts:isCreatedBy:#User|User:isContentCreatorOnly'
            ]
        ]);

        Route::patch('/',[
            'uses' => 'PostController@update',
            'as' => 'posts.update',
            'acl' => [
                'User:hasPermission:post.update',
                'posts:isCreatedBy:#User|User:isContentCreatorOnly'
            ],
        ]);

        Route::delete('/',[
            'uses' => 'PostController@destroy',
            'as' => 'posts.destroy',
            'acl' => [
                'User:hasPermission:post.destroy',
                'posts:isCreatedBy:#User|User:isContentCreatorOnly'
            ]
        ]);

        Route::patch('/restore',[
           'uses' => 'PostController@restore',
            'as' => 'posts.restore',
            'acl' => [
                'User:hasPermission:post.destroy',
                'posts:isCreatedBy:#User|User:isContentCreatorOnly'
            ]
        ]);

        Route::patch('/publish', [
            'uses' => 'PostController@publish',
            'as' => 'posts.publish',
            'acl' => [
                'User:hasPermission:post.publish'
            ]
        ]);

        Route::patch('/unpublish', [
            'uses' => 'PostController@unpublish',
            'as' => 'posts.unpublish',
            'acl' => [
                'User:hasPermission:post.publish'
            ]
        ]);

        Route::patch('/draft', [
            'uses' => 'PostController@draft',
            'as' => 'posts.draft',
            'acl' => [
                'User:hasPermission:post.create',
                'posts:isCreatedBy:#User'
            ]
        ]);

        Route::patch('/contentready',[
            'uses' => 'PostController@contentready',
            'as' => 'posts.contentready',
            'acl' => [
                'User:hasPermission:post.create',
                'posts:isCreatedBy:#User'
            ]
        ]);
    });
});

Route::group(['prefix' => 'users'],function(){
    Route::get('/posts',[
        'uses' => 'PostController@indexAll',
        'as' => 'user.posts',
        'redirect' => 'home',
        'acl' => [
            'User:isNotStudentOnly'
        ]
    ]);

    Route::get('/',[
        'uses' => 'UserController@index',
        'as' => 'users.index',
        'redirect' => 'home',
        'acl' => [
            'User:hasPermission:user.list'
        ]
    ]);

    Route::group(['prefix' => '{users}'],function(){
        Route::get('/',[
            'uses' => 'UserController@show',
            'as' => 'users.show'
        ]);

        Route::get('/edit',[
            'uses' => 'UserController@edit',
            'as' => 'users.edit',
            'acl' => [
                'users:isLoggedIn'
            ]
        ]);

        Route::patch('/',[
            'uses' => 'UserController@update',
            'as' => 'users.update',
            'acl' => [
                'users:isLoggedIn'
            ]
        ]);
    });

});

Route::controllers([
    'auth' => 'AuthController'
]);

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);