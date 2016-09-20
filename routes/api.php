<?php

Route::group(['namespace' => 'Api','as' => 'api.'],function() {

    Route::get('ping',['as' => 'ping'],function() {
        return \Response::json(['ping'=> 1]);
    });

    Route::group(['prefix' => 'v1','namespace' => 'v1','as' => 'v1.'],function(){
        // API v1 routes
        Route::group(['prefix' => 'users'],function(){

            Route::put('{users}/roles',[
                'uses' => 'UserController@syncRoles',
                'as' => 'users.roles.update',
                'acl' => 'UsersGuard@syncRoles'
            ]);
        });

        Route::group(['prefix' => 'media','namespace' => 'Media','as' => 'media.'],function() {
            Route::resource('images','ImageController',['only' => ['index','destroy']]);

            Route::post('images/upload',[
                'uses' => 'ImageController@upload',
                'as' => 'images.upload'
            ]);
        });
    });
});
