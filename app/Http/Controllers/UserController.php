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



    public function userLoginPost(Request $request)
    {
        $credentials = $request->only('code', 'password');

        // Retrieve the user by code (assuming 'code' is a unique identifier)
        $user = \App\Models\User::where('code', $credentials['code'])->first();

        if (!$user) {
            return back()->with([
                'message' => 'User not found',
                'alert-type' => 'error'
            ]);
        }

        if ($user->status == 'Pending') {
            return back()->with([
                'message' => 'Your Account is Not Approved Yet',
                'alert-type' => 'error'
            ]);
        } elseif ($user->status == 'Rejected') {
            return back()->with([
                'message' => 'Your Account is Rejected',
                'alert-type' => 'error'
            ]);
        }

        // Attempt login only if status is "Approved"
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('user-dashboard')->with([
                'message' => 'User Login Successfully',
                'alert-type' => 'success'
            ]);
        } else {
            return back()->with([
                'message' => 'Invalid Credentials',
                'alert-type' => 'error'
            ]);
        }
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

    public function userDashboard()
    {
        $user = Auth::guard('web')->user();
        // dd($user);
        return view('dashboard', compact('user'));
    }
}
