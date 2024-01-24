<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function Index()
  {
    $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();;
    return view('admin.users.index', compact('data'));
    //end method
  }

  public function Create()
  {
    $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
    // $user = User::
    return view('admin.users.create', compact('data'));
    //end method
  }


  public function Store(Request $request)
  {
    $flat_id = $request->id;
    $customer_id = $request->customer_id;

    // $flat_name = $request->flat_name;
    $name = $request->name;
    // var_dump($flat_name);
    $phone = $request->phone;
    $nid_no = $request->nid_no;
    $address = $request->address;
    $email = $request->email;
    for ($i = 0; $i < count($flat_id); $i++) {
      User::insert([
        'id' => $customer_id[$i].$flat_id[$i],
        'customer_id' => $customer_id[$i],
        'flat_id' => $flat_id[$i],
        'name' => $name[$i],
        'phone' => $phone[$i],
        'nid_no' => $nid_no[$i],
        'address' => $address[$i],
        'email' => $email[$i],
        'password' =>Hash::make($phone[$i]),
      ]);
    }
    return redirect()->route('user.index')->with('message', 'User Created Successfully');
  }

  // edit method 
  public function Edit($id)
  {
    $data = User::where('id', $id)->first();
    // $roles = Role::all();
    return view('admin.users.edit', compact('data'));
    //end method
  }
}
