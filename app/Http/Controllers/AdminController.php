<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     // login method start here 
    public function index()
    {
        return view('admin.pages.admin_login');
    } //end method

    public function Dashboard()
    {
        return view('admin.index');
    } //end method

    public function Login(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('admin.dashboard')->with('message', 'Admin login Successfully');
        } else {
            return back()->with('message', 'Invalid Email or Password! ');
        }
        //end method
    }
     // login method ends here 

     // register method start here
     public function AdminRegister()
     {
         return view('admin.pages.admin_register');
     } //end method

     public function store(Request $request)
     {
        Customer::insert([
            'name' =>$request->name,
            'address' =>$request->address,
            'phone' =>$request->phone,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
            'created_at' =>Carbon::now(),
        ]);
       return redirect()->route('login_form')->with('message', 'Admin register Successfully');
         //end method
     }

     // register method ends here

    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('message', 'Admin Logout Successfully');
        //end method
    }
 
}
