<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

use App\Http\Controllers\UUIDController;

class Registrar implements RegistrarContract
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone_no' => 'phone:KE',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'code' => $this->luhnify(),
            'password' => bcrypt($data['password']),
        ]);
    }


    protected function generateVerificationCode($phone_no)
    {
        return str_random(30);;
    }


    function luhnify()
    {
        $code = new UUIDController();

        return strtoupper($code->limit(7));
    }


}
