<?php namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class GetUserFromToken extends BaseMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,\Closure $next) {
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return $this->respond('tymon.jwt.absent', 'token_not_provided', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            // Refreshes token instead of returning expired token response.
            return $this->handleExpiredTokenRequest($request, $next, $token);
        } catch (JWTException $e) {
            return $this->respond('tymon.jwt.invalid', 'token_invalid', Response::HTTP_UNAUTHORIZED, [$e]);
        }

        if (! $user) {
            return $this->respond('tymon.jwt.user_not_found', 'user_not_found', Response::HTTP_NOT_FOUND);
        }

        return $this->handleValidJwtToken($request, $next, $user);
    }

    /**
     * Handles expired token request.
     *
     * @param $request
     * @param \Closure $next
     * @param $token
     * @return mixed
     */
    protected function handleExpiredTokenRequest($request, \Closure $next, $token) {
        $refreshed = JWTAuth::refresh($token);

        $user = $this->auth->authenticate($refreshed);

        $response = $this->handleValidJwtToken($request, $next, $user);

        $response->headers->set('Authorization', 'Bearer ' . $refreshed);

        return $response;
    }

    /**
     * Handles Valid Token request.
     *
     * @param $request
     * @param \Closure $next
     * @param $user
     * @return mixed
     */
    protected function handleValidJwtToken($request, \Closure $next, $user) {
        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}