<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:15', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function registered(Request $request, $user)
    {
       if (!empty($user))
           return redirect(route('user.mobile_verify', $user->mobile));
        // return redirect(route('register'))->with('success', __('user.your_registration_was_successful_please_check_your_mobile'));
    }

    protected function create(array $data)
    {

        $otp = rand(10000, 99999);

        $user = User::create([
            // 'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => $data['password'],
            'mobile_confirmation' => $otp,
        ]);

        if ($user) {
            $success = 1;
            speedSend($data['mobile'], 43279, array(
                ["Parameter" => "VerificationCode", "ParameterValue" => $otp]
            ));

        }
        return $user;
    }

    /* if we want login remove register function from this file */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //$this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        return view(currentFrontView('auth.register'));
    }
}
