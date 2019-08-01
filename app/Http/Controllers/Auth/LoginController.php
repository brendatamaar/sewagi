<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request as HttpRequest;
use App\Models\User;
use Socialite;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        // $this->middleware('guest')->except('logout');
        $this->user = $user;
    }
    
    public function login(HttpRequest $request)
    {
        $remember = isset($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if(Auth::user()->hasRole('administrator')){ 
                return response()->json([
                    'status' => true,
                    'role' => 'admin'
                ]);
            }
            return response()->json(['status' => true]);
        } 

        $user = $this->user->findByColumn('email', $request->email);
        $statusMessage = ($user) ? 'password' : 'email or password';
        return response()->json([
            'status' => false,
            'message' => "Opps, you have input wrong {$statusMessage}, please try again." 
        ], 401);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $credential = Socialite::driver($provider)->user();
        $user = $this->user->findByColumn('email', $credential->email);
        if ($user) {
            auth()->login($user);
            return redirect()->back();
        } else {
            return redirect()
                    ->back()
                    ->with('action', 'email-not-found')
                    ->with('email', $credential->email);
        }
    }

    public function logout()
    {   
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out');
    }
}
