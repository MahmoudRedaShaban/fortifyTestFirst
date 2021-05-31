<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;


class AdminForgotPasswordcontroller extends Controller
{


    use SendsPasswordResetEmails;

    public function _construct()
    {
        return true;
    }

    protected function broker()
    {
        return Password::broker('admins');
    }
    protected function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
}
