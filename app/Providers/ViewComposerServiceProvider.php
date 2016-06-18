<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    /**
     * Registers bindings in the container.
     *
     * @return void
     */
    public function boot(){
        \View::composer('*','App\Http\ViewComposers\PostCategoryComposer');
        \View::composer('_partials.posts.save','App\Http\ViewComposers\SavePostComposer');
        \View::composer('_partials.users.role-editor','App\Http\ViewComposers\RolesComposer');
        \View::composer('_partials.posts.recent-posts','App\Http\ViewComposers\RecentPostComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){

    }
}
