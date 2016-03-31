<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers;

    /**
     * Path to redirect after the user is logged in.
     *
     * @var string
     */
    protected $redirectPath = "/";

    /**
     * Path to redirect to if the user is already logged in and try to access login page.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Path to redirect to for the user to login.
     *
     * @var string
     */
    protected $loginPath = "/users/login";

    /**
     * Create a new AuthController instance.
     *
     * @param Guard $auth
     * @param Registrar $registrar
     */
    public function __construct(Guard $auth,Registrar $registrar){
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }
}
