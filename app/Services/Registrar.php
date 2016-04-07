<?php namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return \Validator::make($data, [
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