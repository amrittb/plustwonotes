<?php

namespace App\Repositories\Providers;


use Illuminate\Support\ServiceProvider;

class SubjectRepositoryProvider extends ServiceProvider{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        $this->app->bind('\App\Repositories\Contracts\SubjectRepositoryInterface','\App\Repositories\SubjectRepository');
    }
}