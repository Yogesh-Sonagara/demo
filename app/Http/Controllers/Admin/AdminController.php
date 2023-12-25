<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            // validation
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid email is required',
                'password.required' => 'Password is required'
            ];
            $this->validate($request, $rules, $customMessages);
            // authenticate user
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->with('error', 'Invalid email or password!');
            }
        }
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function updateAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            // check if current password entered by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                // check if confirm password is matching with new password
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success', 'Password has been updated successfully.');
                } else {
                    return redirect()->back()->with('error', 'New password and Confirm password does not match!');
                }
            } else {
                return redirect()->back()->with('error', 'Your current password is incorrect!');
            }
        }
        return view('admin.settings.update_admin_password');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            // validation
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric'
            ];
            $customMessages = [
                'name.required' => 'Name is required',
                'name.regex' => 'Valid name is required',
                'mobile.required' => 'Mobile number is required',
                'mobile.numeric' => 'Valid mobile number is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // upload admin photo
            if ($request->hasFile('image')) {
                $image = Image::make($request->file('image'));
                $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
                $destinationPath = public_path('admin/images/photos/');
                $image->resize(100, 100);
                $image->save($destinationPath . $imageName);
                $data['image'] = $imageName;
            }

            // update admin details
            Admin::where('id', Auth::guard('admin')->user()->id)->update($data);
            return redirect()->back()->with('success', 'Admin details updated successfully.');
        }
        return view('admin.settings.update_admin_details');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
