<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function indexAdmin()
    {
        return view('admin.manage_user.admin');
    }

    public function indexUser()
    {
        return view('admin.manage_user.user');
    }

    public function ajaxAdmin()
    {
        return $this->user->ajaxDatatables(config('constants.role_admin'));
    }

    public function ajaxUser()
    {
        return $this->user->ajaxDatatables(config('constants.role_user'));
    }

    public function updateStatus(Request $request, $id)
    {
        return response()->json($this->user->find($id)->update($request->all()));
    }
}
