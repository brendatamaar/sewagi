<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back()
                ->with('success', __('alert.admin.profile.updated'));
    }
}
