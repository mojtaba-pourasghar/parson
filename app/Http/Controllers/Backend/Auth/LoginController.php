<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('backend.dashbord');
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view(currentBackView('auth.login'));
    }


    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password, 'state' => 1, 'is_admin' => 1], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('backend.dashbord'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withErrors([__('message.email_or_password_are_incorrect')]);
    }


}
