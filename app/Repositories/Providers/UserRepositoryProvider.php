<?php namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        $this->app->bind('\App\Repositories\Contracts\UserRepositoryInterface','\App\Repositories\UserRepository');
    }
}