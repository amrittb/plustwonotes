<?php

Route::group(['namespace' => 'Api','as' => 'api.'],function() {

    Route::get('ping',['as' => 'ping'],function() {
        return \Response::json(['ping'=> 1]);
    });

    Route::post('authenticate',[
      'as' => 'authenticate',
      'uses' => 'Auth\TokenController@authenticate'
    ]);

    Route::group([
                    'prefix' => 'v1',
                    'namespace' => 'v1',
                    'as' => 'v1.',
                    'middleware' => 'jwt.auth'
    ],function(){
        // API v1 routes
        Route::group(['prefix' => 'users'],function(){

            Route::put('{users}/roles',[
                'uses' => 'UserController@syncRoles',
                'as' => 'users.roles.update',
                'middleware' => 'can:updateRoles,App\Models\User',
            ]);
        });

        Route::group(['prefix' => 'media','namespace' => 'Media','as' => 'media.'],function() {
            Route::resource('images','ImageController',['only' => ['index','destroy']]);

            Route::post('images/upload',[
                'uses' => 'ImageController@upload',
                'as' => 'images.upload'
            ]);
        });

        Route::get('grades',[
            'uses' => 'GradesController@index',
            'as' => 'grades.index'
        ]);

        Route::get('categories',[
            'uses' => 'CategoriesController@index',
            'as' => 'categories.index'
        ]);

        Route::get('posts',[
            'uses'  => 'PostsController@index',
            'as'    => 'posts.index',
        ]);

        Route::get('posts/{id}',[
            'uses'  => 'PostsController@show',
            'as'    => 'posts.show'
        ]);
    });
});
