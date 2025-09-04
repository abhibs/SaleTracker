<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userLogin()
    {
        return view('login');
    }

    public function userRegister()
    {
        return view('register');
    }
}
