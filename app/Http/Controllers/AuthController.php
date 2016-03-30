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
