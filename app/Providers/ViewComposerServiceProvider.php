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
        \View::composer('_partials.posts.save','App\Http\ViewComposers\SavePostComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){

    }
}