<?php

Route::group(['namespace' => 'Api'],function() {

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
