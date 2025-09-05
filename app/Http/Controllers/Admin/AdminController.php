<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('email', 'password');
        $credentials['password'] = $request->password;
        // dd($credentials);
        if (Auth::guard('admin')->attempt($credentials)) {
            // dd('hi');
            $notification1 = array(
                'message' => 'Admin Login Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin-dashboard')->with($notification1);
        } else {
            $notification2 = array(
                'message' => 'Invalid Credentials',
                'alert-type' => 'error'
            );
            return back()->with($notification2);
        }
    }


    public function dashboard()
    {

        return view('admin.index');
    }

    public function adminLogout()
    {
        Auth::logout();
        $notification = array(
            'message' => 'Admin Logout Successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin-login')->with($notification);
    }


    public function adminChangePassword()
    {
        // dd(auth::user());
        return view('admin.change_password');
    }


    public function adminChangePasswordPost(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        Admin::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password),
            'password_hint' => $request->new_password
        ]);
        return back()->with("status", " Password Changed Successfully");
    }


    public function adminProfile(){
        $user = Auth::guard('admin')->user();
        // dd($user);
        return view('admin.profile', compact('user'));
    }



    public function adminProfileUpdate(Request $request)
    {
        // $admin = Admin::first();
        $admin = Auth::guard('admin')->user();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('storage/admin/' . $admin->image));
            $filename = 'admin' . time() . '.' . $image->getClientOriginalExtension();

            // installing image intervention
            // composer require intervention/image

            // config/app.php
            // Intervention\Image\ImageServiceProvider::class,
            // 'Image' => Intervention\Image\Facades\Image::class,

            // php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"


            Image::make($image)->resize(256, 256)->save('storage/admin/' . $filename);
            $filePath = 'storage/admin/' . $filename;
            $admin->image = $filename;
        }
        $admin->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    public function addAdmin(){
        return view('admin.admin_add');
    }



    public function addAdminPost(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required'],
            'phone' => ['required'],
            'image' => ['required'],
            'address' => ['required'],
            'password' => ['required'],
        ]);


        $image = $request->file('image');
        $name_gen = 'admin' . time() . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(256, 256)->save('storage/admin/' . $name_gen);
        $save_url = $name_gen;

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->password = Hash::make($request->password);
        $admin->password_hint = $request->password;
        $admin->image = $save_url;
        $admin->save();

        $notification = array(
            'message' => 'New Team Member Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all-admin')->with($notification);
    }

    public function allAdmin(){
        $datas = Admin::where('id', '!=', 1)
              ->latest()
              ->get();

        return view('admin.all_admin', compact('datas'));
    }



    public function inactive($id)
    {
        Admin::findOrFail($id)->update(['status' => 0]);
        // dd($data);
        $notification = array(
            'message' => 'Team Member Inactive Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        Admin::findOrFail($id)->update(['status' => 1]);
        // dd($data);
        $notification = array(
            'message' => 'Team Member Active Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
