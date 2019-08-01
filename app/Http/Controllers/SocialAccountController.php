<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialAccount;

class SocialAccountController extends Controller
{
    public function __construct(SocialAccount $social_account)
    {
        $this->social_account = $social_account;
    }

    public function show($id)
    {
        $account = $this->social_account->find($id);
        return response()->json($account);
    }
}
