<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use Validator;

use Zjango\Laracurl\Facades\Laracurl;


use App\Http\Controllers\SmsController;


use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{

//    protected $redirectTo = '/admin';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     * @return void
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }


//    public function getRegister(){
//        return redirect('/');
//    }

    public function postRegister(Request $request)
    {
        $validator = $this->registrar->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->registrar->create($request->all());


        $this->sendVerificationCode($user->phone_no, $user->code, $user->id);


        ///verify
//        return redirect('/verify');
        return redirect('/verify')->with('message', 'Successfully registered. Verify your count with the code received');
    }


    public function postVerification(Request $request)
    {
        $v = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }

        $data = User::whereCode($request->code)->first();
        if (count($data) > 0) {
            $data->verified = 1;

            $data->save();
            return redirect('auth/login');
        } else {
            return redirect()->back()->with('message', 'Inavlid code!');
        }
    }

    public function getVerification()
    {
        return view('auth.verify');
    }


    public function sendVerificationCode($number, $message, $user_id)
    {

        $sms = new SmsController();


        $sms->sendSms($this->makeNumberInternational($number), $message, $user_id);

    }


    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $user = User::whereEmail($request->email)->first();
        if ($user->verified == 0) {
            return redirect('/verify');
        } else {
            $credentials = $request->only('email', 'password');

            if ($this->auth->attempt($credentials, $request->has('remember'))) {
                return redirect()->intended($this->redirectPath());
            }

            return redirect($this->loginPath())
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $this->getFailedLoginMessage(),
                ]);
        }
    }


    protected function makeNumberInternational($phone_number)
    {
        $first_digit = substr($phone_number, 0, 1);
        if ($first_digit == 0) {
            return "+254" . substr($phone_number, 1, 9);
        }
    }


}
