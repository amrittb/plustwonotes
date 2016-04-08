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
		Blade::extend(function($value,$compiler){
			$pattern = $compiler->createOpenMatcher('haspermission');

			return preg_replace($pattern,"$1<?php if(Auth::check() and Auth::user()->hasPermission$2)): ?>",$value);
		});

		Blade::extend(function($value,$compiler){
			$pattern = $compiler->createPlainMatcher('endhaspermission');

			return preg_replace($pattern,"$1<?php endif; ?>",$value);
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
