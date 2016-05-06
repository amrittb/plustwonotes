<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::get('about',['uses' => 'HomeController@about', 'as' => 'about']);

Route::get('search',['uses' => 'HomeController@search','as' => 'search']);

//  /posts group
Route::group(['prefix' => 'posts'], function(){
    Route::get('/',[
        'uses' => 'PostController@index',
        'as' => 'posts.index'
    ]);

    Route::get('/create',[
        'uses' => 'PostController@create',
        'as' => 'posts.create',
        'acl' => 'PostsGuard@createPost'
    ]);

    Route::post('/',[
        'uses' => 'PostController@store',
        'as' => 'posts.store',
        'acl' => 'PostsGuard@createPost'
    ]);

    Route::get('/trashed',[
        'uses' => 'PostController@trashed',
        'as' => 'posts.trashed',
        'acl' => 'PostsGuard@readDestroyedPost'
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
            'acl' => 'PostsGuard@editPost'
        ]);

        Route::patch('/',[
            'uses' => 'PostController@update',
            'as' => 'posts.update',
            'acl' => 'PostsGuard@editPost'
        ]);

        Route::delete('/',[
            'uses' => 'PostController@destroy',
            'as' => 'posts.destroy',
            'acl' => 'PostsGuard@destroyPost'
        ]);

        Route::patch('/restore',[
           'uses' => 'PostController@restore',
            'as' => 'posts.restore',
            'acl' => 'PostsGuard@destroyPost'
        ]);

        Route::patch('/publish', [
            'uses' => 'PostController@publish',
            'as' => 'posts.publish',
            'acl' => 'PostsGuard@publishPost'
        ]);

        Route::patch('/unpublish', [
            'uses' => 'PostController@unpublish',
            'as' => 'posts.unpublish',
            'acl' => 'PostsGuard@publishPost'
        ]);

        Route::patch('/draft', [
            'uses' => 'PostController@draft',
            'as' => 'posts.draft',
            'acl' => 'PostsGuard@draftPost'
        ]);

        Route::patch('/contentready',[
            'uses' => 'PostController@contentready',
            'as' => 'posts.contentready',
            'acl' => 'PostsGuard@draftPost'
        ]);
    });
});

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

Route::controllers([
    'auth' => 'AuthController'
]);

Route::group(['prefix' => 'api','namespace' => 'Api'],function(){

    Route::group(['prefix' => 'v1','namespace' => 'v1'],function(){
        // API v1 routes
        Route::group(['prefix' => 'users'],function(){

            Route::put('{users}/roles',[
                'uses' => 'UserController@syncRoles',
                'as' => 'api.v1.users.roles.update',
                'acl' => 'UsersGuard@syncRoles'
            ]);
        });
    });
});

Route::get('/{category}',['uses' => 'PostController@listCategory','as' => 'posts.index.category']);