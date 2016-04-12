<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Acl\HandlesActionControl;

class ActionControl {

	use HandlesActionControl;

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next) {
		$flag = $this->handleActionControl($request);

		if( ! $flag){
			$actions = $request->route()->getAction();

			$redirectRoute = array_has($actions,'redirect')?$actions['redirect']:'home';

			return redirect(route($redirectRoute));
		}

		return $next($request);
	}
}
