<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function Index()
  {
    $flat = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();;
    if(!empty($flat)){
      $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
      return view('admin.users.index', compact('data'));
    }
    // $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();;
    return view('admin.users.index');
    //end method
  }

  public function Create()
  {
    $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->where('status', 0)->get();
    return view('admin.users.create', compact('data'));
    //end method
  }


  public function Store(Request $request)
  {
    $flat_unique_id = $request->flat_unique_id;
    $customer_id = $request->customer_id;
    $amount = $request->amount;
    $charge = $request->charge;

    $name = $request->name;
    $phone = $request->phone;
    $nid_no = $request->nid_no;
    $address = $request->address;
    $email = $request->email;
    for ($i = 0; $i < count($flat_unique_id); $i++) {
      User::insert([
        'user_id' => Auth::guard('admin')->user()->id . $flat_unique_id[$i],
        'customer_id' => $customer_id[$i],
        'flat_id' => $flat_unique_id[$i],
        'amount' => $amount[$i],
        'charge' => $charge[$i],
        'name' => $name[$i],
        'phone' => $phone[$i],
        'nid_no' => $nid_no[$i],
        'address' => $address[$i],
        'email' => $email[$i],
        'password' =>Hash::make($phone[$i]),
      ]);
      $status['status'] = 1;
      DB::table('flats')->update($status);

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
