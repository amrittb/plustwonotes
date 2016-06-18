<?php namespace App\Providers;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Post;
use App\Models\User;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		$this->bindCategory($router);

		$this->bindPost($router);

		$this->bindGrade($router);

		$this->bindUser($router);
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

	/**
	 * Bind a \App\Models\Category Model to the route.
	 *
	 * @param Router $router
	 */
	public function bindCategory(Router $router)
	{
		$router->bind('category', function ($category) {
			return Category::where('category_slug', $category)->firstOrFail();;
		});
	}

	/**
	 * Bind a \App\Models\Post Model to the route.
	 *
	 * @param Router $router
	 */
	public function bindPost(Router $router)
	{
		$router->bind('posts', function ($post) {
			if(is_numeric($post)){
				return Post::onlyTrashed()->findOrFail($post);
			}
			return Post::where('post_slug', $post)->firstOrFail();
		});
	}

	/**
	 * Binds a \App\Models\Grade Model to the route.
	 *
	 * @param Router $router
	 */
	private function bindGrade(Router $router) {
		$router->bind('grade',function($grade) {
			return Grade::where('grade_name',$grade)->firstOrFail();
		});
	}

	/**
	 * Bind a \App\Models\User Model to the route.
	 *
	 * @param Router $router
     */
	private function bindUser(Router $router) {
		$router->bind('users',function($user){
			return User::where('username',$user)->firstOrFail();
		});
	}
}
