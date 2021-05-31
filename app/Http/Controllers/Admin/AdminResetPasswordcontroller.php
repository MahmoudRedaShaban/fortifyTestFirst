<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AdminResetPasswordcontroller extends Controller
{


    use ResetsPasswords;

    protected $redirectTo = '/admin/index';


    public function _construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guared()
    {
        return Auth::guard('admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }

    protected function showResetForm(Request $request, $token=null)
    {
        return view('auth.passwords.reset-admin')->with(['token'=>$token, 'email'=>$request->email]);
    }
}
