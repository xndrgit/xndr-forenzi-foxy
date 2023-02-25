<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->is_banned == 1) {
                Auth::logout();
                return response()->json(['errors' => [0 => 'You are Banned From this system!']]);
            }

            if (Auth::user()->email_verified == 'No') {
                Auth::logout();
                return response()->json(['errors' => [0 => 'Your Email is not Verified!']]);
            }

            if (session()->get('setredirectroute') != NULL) {
                return response()->json(session()->get('setredirectroute'));
            }

            $user = auth()->user();
            $user->update(['verified' => 1]);

            $role = User::with('userroles')->where('id', $user->id)->first();

            foreach ($role->userroles as $role) {
                if ($role->role_id == 1)//is admin
                    return redirect('/admin/home');
                else if ($role->role_id == 2)//is user
                    return redirect('/');
            }

            return view('guest.home');//is guest
        }

        return view('auth.login')->with('message', 'Don\'t match');
    }

    public function logout()
    {
        Auth::logout();

        session()->forget('setredirectroute');
        session()->forget('affilate');

        return redirect('/');
    }
}
