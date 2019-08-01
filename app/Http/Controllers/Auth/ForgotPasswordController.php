<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request as HttpRequest;
use App\Models\User;
use GuzzleHttp;
use Exception;
use Validator;
use Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }
    public function sendResetLinkEmailByPhoneNumber(HttpRequest $request)
    {
        try {
            if($request){
                $user = User::where('phone_number', $request->phone_number)->first();
                if(!empty($user->phone_number)){
                    $token = app('auth.password.broker')->createToken($user);
                    $message = 'Your Password Reset Link: http://sewagi/reset-password/' . $token;
                    $client = new GuzzleHttp\Client();
                    $res = $client->request('GET', config('constants.tcastsmsUrl') . '?username=' . config('constants.tcastsmsUsername') . '&password=' . config('constants.tcastsmsPassword') . '&type=0&dlr=1&destination=' . str_replace('+', '', $user->calling_code) . $user->phone_number . '&source=TCASTSMS&message=' . $message);
                }
                else{
                    return redirect()->back()->with('errorForgotPasswordByPhoneNumber', 'Phone number not registered, please try again');
                }
            }
            else{
                return redirect()->back()->with('errorForgotPasswordByPhoneNumber', 'Phone number not registered, please try again');
            }
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }

        return response()->json(['status' => true]);
    }
    public function checkEmail(HttpRequest $request)
    {
        if($request->email != ''){
            $user = User::where('email', $request->email)->first();
            if(empty($user)){
                return response()->json([
                    'error' => 'please fill with correct email address',
                ]);
            }
        }
        else{
            return response()->json([
                'error' => 'please fill with correct email address',
            ]);
        }
    }
    public function checkPhoneNumber(HttpRequest $request)
    {
        if($request->phone_number != ''){
            $user = User::where('phone_number', $request->phone_number)->first();
            if(empty($user)){
                return response()->json([
                    'error' => 'please fill with correct phone number',
                ]);
            }
        }
        else{
            return response()->json([
                'error' => 'please fill with correct phone number',
            ]);
        }
    }

    public function checkPassword(HttpRequest $request)
    {
        if(Hash::check($request->password, auth()->user()->password)){
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
