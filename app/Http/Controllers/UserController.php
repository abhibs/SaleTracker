<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sale;



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



    public function salesPost(Request $request)
    {
        $request->validate([
            'shop_name' => ['required'],
            'shop_type' => ['required'],
            'mobile_no' => ['required'],
            'sale_amount' => ['required'],
            'sale_representative_name' => ['required'],
            'visit_notes' => ['required'],
            'location' => ['required'],
            'shop_address' => ['required'],
            'image' => ['required'],
        ]);


        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('storage/sales'), $name_gen);
        // Get the path to the saved image
        $save_url = 'storage/sales/' . $name_gen;


        $sale = new Sale();
        $sale->user_id = Auth::id();
        $sale->shop_name = $request->shop_name;
        $sale->shop_type = $request->shop_type;
        $sale->mobile_no = $request->mobile_no;
        $sale->sale_amount = $request->sale_amount;
        $sale->sale_representative_name = $request->sale_representative_name;
        $sale->visit_notes = $request->visit_notes;
        $sale->location = $request->location;
        $sale->shop_address = $request->shop_address;
        $sale->image = $save_url;
        $sale->save();

        $notification = array(
            'message' => 'Sales Information Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user-dashboard')->with($notification);

    }
}
