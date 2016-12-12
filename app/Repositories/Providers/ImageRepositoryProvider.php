<?php namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class ImageRepositoryProvider extends ServiceProvider {

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('\App\Repositories\Contracts\ImageRepositoryInterface','\App\Repositories\ImageRepository');
    }

}
