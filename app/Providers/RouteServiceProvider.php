<?php namespace App\Providers;

use App\Models\Category;
use App\Models\Grade;
use App\Models\Post;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as RouteFacade;

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
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		$this->bindCategory();

		$this->bindPost();

		$this->bindGrade();

		$this->bindSubject();

		$this->bindUser();
	}

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        RouteFacade::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        RouteFacade::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

	/**
	 * Bind a \App\Models\Category Model to the route.
	 */
	public function bindCategory()
	{
        RouteFacade::bind('category', function ($category) {
			return Category::where('category_slug', $category)->firstOrFail();;
		});
	}

	/**
	 * Bind a \App\Models\Post Model to the route.
	 */
	public function bindPost()
	{
        RouteFacade::bind('posts', function ($post) {
			if(is_numeric($post)){
				return Post::onlyTrashed()->findOrFail($post);
			}
			return Post::where('post_slug', $post)->firstOrFail();
		});
	}

	/**
	 * Binds a \App\Models\Grade Model to the route.
	 */
	private function bindGrade() {
        RouteFacade::bind('grade',function($grade) {
			return Grade::where('grade_name',$grade)->firstOrFail();
		});
	}

	/**
	 * Binds a \App\Models\Subject Model to the route.
	 */
	private function bindSubject() {
        RouteFacade::bind('subject',function($subject,Route $route) {
			return Subject::where('subject_slug',$subject)
							->where('grade_id',$route->getParameter('grade')->id)
							->firstOrFail();

		});
	}

	/**
	 * Bind a \App\Models\User Model to the route.
     */
	private function bindUser() {
        RouteFacade::bind('users',function($user){
			return User::where('username',$user)->firstOrFail();
		});
	}
}
