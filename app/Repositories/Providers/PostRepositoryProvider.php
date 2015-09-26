<?php namespace App\Repositories\Providers;

use Illuminate\Support\ServiceProvider;

class PostRepositoryProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('\App\Repositories\Contracts\PostRepositoryInterface','\App\Repositories\PostRepository');
	}

}
