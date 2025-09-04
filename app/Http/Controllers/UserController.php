<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;


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



    public function userRegisterPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required'],
            'password' => ['required', 'confirmed'],
        ]);

        $randomNumber = rand(00001, 99999);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->code = 'panmasala' . $randomNumber;
        $user->password = Hash::make($request->password);
        $user->password_hint = $request->password;
        $user->status = 'Pending';
        $user->save();

        $notification = array(
            'message' => 'User Registered Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
    }
}
