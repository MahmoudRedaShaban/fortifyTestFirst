<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('admin');
    }

    public function logoutUser(Request $request)
    {
        Auth::guard('web')->logout();



        return app(LogoutResponse::class);
    }

    public function distroy(Request $request)
    {
        Auth::guard('admin')->logout();



        return app(LogoutResponse::class);
    }
}
