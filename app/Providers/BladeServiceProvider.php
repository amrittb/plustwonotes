<?php namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class BladeServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot() {
		Blade::directive('haspermission',function($expression) {
			return "<?php if(Auth::check() and Auth::user()->hasPermission({$expression})): ?>";
		});

		Blade::directive('endhaspermission',function() {
			return "<?php endif; ?>";
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
