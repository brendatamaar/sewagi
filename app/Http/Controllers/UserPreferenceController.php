<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserPreferenceController extends Controller
{
    public function __construct(UserPreference $user_preference)
    {
        $this->user_preference = $user_preference;
    }

    public function saveData(Request $request)
    {
        $user_preference = $this->user_preference->saveData($request->all());

        return response()->json([
            'status' => true,
        ]);
    }
}
