<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VerificationCode;

class VerificationController extends Controller
{
    public function __construct(VerificationCode $verification)
    {
        $this->verification = $verification;
    }

    public function verifyEmail($code)
    {
        $verification = $this->verification->getActive($code);
        $user = $verification->user;
        $user->update(['email_verified_at' => now()]);
        return redirect('/')->with('status', 'email verified');
    }
}
