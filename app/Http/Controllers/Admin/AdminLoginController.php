<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    //
    public function login_show()
    {
        return view('auth.admin.admin-login');
    }


    public function login(Request $request)
    {
        // Validate the form Data
        $credentials= $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
            ]);
        // Attempt to log the user in
        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
            // if successful, then redirect ro their indended location
            return redirect()->intended(route('admin.index'));
        }

        // if unsucessful, than redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }
}
