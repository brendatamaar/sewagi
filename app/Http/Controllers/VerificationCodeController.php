<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as HttpRequest;
use App\Models\VerificationCode;
use App\Models\User;
use App\Http\Requests\VerificationCodeRequest;
use GuzzleHttp;
use Exception;
use Validator;
use App\Notifications\SmsVerification;

class VerificationCodeController extends Controller
{
    public function verifyPhoneNumber(HttpRequest $request)
    {
        $verification = new VerificationCode;
        $obj = $verification->getActive($request->code);
        $user = User::where('phone_number', $request->phone)->first();
        if(!isset($obj)){
            $data = [
                'error' => 'verification code has been expired',
            ];
            if(isset($user)){
                $data['data'] = $user;
            }
            return response()->json($data);
        }
        else{
            $user = $obj->user;
            $user->update(['phone_verified_at' => now()]);

            return response()->json([
                'status' => true
            ]);
        }
    }
    public function resendVerificationCode(HttpRequest $request)
    {
        $user = User::find($request->user_id);
        if(isset($user)){
            $user->notify(new SmsVerification());
            $verificationCode = VerificationCode::where('user_id', $user->id)->where('type', 'phone')->orderBy('created_at', 'desc')->first();
            return response()->json([
                'status' => true,
                'data' => $user,
                'verification_code' => $verificationCode

            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
    public function changePhoneNumber(HttpRequest $request)
    {
        try{
            $user = User::find($request->user_id);
            $user->update([
                'calling_code' => $request->calling_code,
                'phone_number' => $request->phone_number,
            ]);
            $verificationCode = new VerificationCode;
            $data = [
                'user_id'       => $request->user_id,
                'type'          => 'phone',
                'code'          => mt_rand(1000, 9999),
                'expired_at'    => now()->addMinutes(3),
            ];
            $verificationCode->createNew($data);
            if(!empty($request->phone_number)){
                $phoneNumber = $request->phone_number;
                if(strlen($phoneNumber) > 4){
                    for ($i = 0; $i < strlen($phoneNumber) - 3; $i++) {
                        $phoneNumber = substr_replace($phoneNumber, '*', $i, 1);
                    }
                }
                $message = $data['code'] . ' is your verification code.';
                $client = new GuzzleHttp\Client();
                $res = $client->request('GET', config('constants.tcastsmsUrl') . '?username=' . config('constants.tcastsmsUsername') . '&password=' . config('constants.tcastsmsPassword') . '&type=0&dlr=1&destination=' . str_replace('+', '', $request->calling_code) . $request->phone_number . '&source=TCASTSMS&message=' . $message);
            }
            return response()->json([
                'phoneNumber' => $request->phone_number,
                'phoneNumberFormatted' => $phoneNumber,
                'expiredAt' => $data['expired_at'],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
