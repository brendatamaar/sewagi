<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterSocialRequest;
use App\Http\Requests\RegisterCompanyRequest;
use App\Notifications\EmailVerification;
use App\Notifications\SmsVerification;
use App\Rules\Age;
use Socialite;
use App\Models\SocialAccount;
use App\Models\Company;
use App\Models\VerificationCode;
use App\Models\UserPreference;
use GuzzleHttp;
use Exception;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{
    public function __construct(User $user, SocialAccount $social_account)
    {
        // $this->middleware('guest');
        $this->user = $user;
        $this->social_account = $social_account;
    }

    public function checkEmail(Request $request)
    {
        $check = $this->user->where('email', $request->email);
        if ($check->count()) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function checkDob(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dob' => 'required|date_format:d/m/Y|before:-18 years ',
        ]);
        if ($validator->fails()) {
            return 'false';
        } else {
            return 'true';
        }
    }

    /**
     * Create a new user
     * url: register POST
     */
    public function create(RegisterRequest $request)
    {
        $user = $this->user->createNew($request->all());
        $user->attachRole('2');
        $user->syncRoles(['2']);

        $user->notify(new EmailVerification());
        return response()->json([
            'status' => true,
            'data'   => $user
        ]);
    }

    public function registerSocial(RegisterSocialRequest $request)
    {
        $user = $this->user->createNew($request->all());
        $user->attachRole('2');
        $user->syncRoles(['2']);

        $user->notify(new SmsVerification());
        $verificationCode = VerificationCode::where('user_id', $user->id)->where('type', 'phone')->orderBy('created_at', 'desc')->first();
        return response()->json([
            'status' => true,
            'data' => $user,
            'verification_code' => $verificationCode
        ]);
    }

    public function redirectToProvider($provider)
    {
        $redirectUrl = url("register/{$provider}/callback");
        return Socialite::driver($provider)
                ->redirectUrl($redirectUrl)
                ->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $redirectUrl = url("register/{$provider}/callback");
        $credential = Socialite::driver($provider)->redirectUrl($redirectUrl)->user();

        $social_account = $this->social_account->saveData($provider, $credential);
        $user = $this->user->findByColumn('email', $credential->email);
        if ($user) {
            auth()->login($user);
            return redirect()->back();
        } else {
            return redirect('/')
                ->with('action', 'signup-social')
                ->with('account_id', $social_account->id);
        }
    }
    public function registerCompany(RegisterCompanyRequest $request)
    {
        try {
            $company = Company::createNew($request);
            $user = $this->user->createNew($request, $company->id);
            $user->attachRole('2');
            $user->syncRoles(['2']);

            $request['user_id'] = $user->id;
            $userPreference = new UserPreference;
            $userPreference->saveData($request);
            $user->notify(new SmsVerification());
            $verificationCode = VerificationCode::where('user_id', $user->id)->where('type', 'phone')->orderBy('created_at', 'desc')->first();
            return response()->json([
                'data'   => $user,
                'verification_code' => $verificationCode
           ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
