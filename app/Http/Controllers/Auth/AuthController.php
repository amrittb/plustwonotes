<?php namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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
     * Create a new AuthController instance.
     */
    public function __construct(){
        $this->middleware('guest', ['except' => ['logout','getLogout']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
            'first_name' => 'required|min:3,max:20',
            'last_name' => 'required|min:3,max:20',
            'username' => 'required|min:3,max:20|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data) {
        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => (trim($data['middle_name']) != "")?$data['middle_name']:null,
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status_id' => User::STATUS_ACTIVE
        ]);

        //  Saving user's default role as a student.
        $user->roles()->save(Role::where('name','=','Student')->firstOrFail());

        return $user;
    }
}
