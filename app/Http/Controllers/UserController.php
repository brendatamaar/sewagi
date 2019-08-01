<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;

class UserController extends Controller
{
    function checkEmail(HttpRequest $request) {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if(empty($user)){
            $data['success'] = false;
            $data['email'] = $email;
        } else{
            $data['success'] = true;
        }
        return response()->json($data, 200);
    }
}
