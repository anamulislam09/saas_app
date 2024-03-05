<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Income;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function Index()
  {
    $flat = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();;
    if (!empty($flat)) {
      $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
      return view('admin.users.index', compact('data'));
    }
    // $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();;
    return view('admin.users.index');
    //end method
  }

  //create multiple user method start here
  public function Create()
  {
    $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->exists();
    if (!$data) {
      return redirect()->back()->with('message', 'Pls! Flat create first');
    } else {
      $data = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
      return view('admin.users.create', compact('data'));
      //end method
    }
  }

  public function Store(Request $request)
  {
    $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->exists();
    if (!$data) {
      return redirect()->back()->with('message', 'Pls! Flat create first');
    } else {

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
        $user = User::insert([
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
          'password' => Hash::make($phone[$i]),
        ]);
        $status['status'] = 1;
        DB::table('flats')->update($status);
      }

      return redirect()->route('users.index')->with('message', 'User Created Successfully');
    }
  }
  //create multiple user method ends here

  //create single user method start here
  public function SingleCreate()
  {
    return view('admin.users.create_single');
    //end method
  }

  public function SingleStore(Request $request)
  {
    $name = $request->name;
    $user_id  = $request->user_id;
    $phone = $request->phone;
    $nid_no = $request->nid_no;
    $address = $request->address;
    $email = $request->email;

    $user = User::insert([
      'user_id' => $user_id,
      'customer_id' => Auth::guard('admin')->user()->id,
      'name' => $name,
      'phone' => $phone,
      'nid_no' => $nid_no,
      'role_id' => 1,
      'address' => $address,
      'email' => $email,
      'password' => Hash::make($phone),
    ]);
    return redirect()->route('users.index')->with('message', 'User Created Successfully');
  }
  //create single user method emds here

  // edit method 
  public function Edit($id)
  {
    $data = User::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
    // $roles = Role::all();
    return view('admin.users.edit', compact('data'));
    //end method
  }

  public function Update(Request $request)
  {
    $id = $request->id;
    $customer_id = $request->customer_id;
    $data = User::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $id)->first();
    $data['name'] = $request->name;
    $data['email'] = $request->email;
    $data['status'] = $request->status ? 1 : 0;
    $data->save();
    return redirect()->back()->with('message', 'User update successfully');
    //end method
  }

  /*-----------------User login start here-------------------*/
  public function LoginForm()
  {
    return view('user.user_profile.login');
  }

  public function Login(Request $request)
  {
    $IsManager = User::where('user_id', $request->user_id)->where('phone', $request->password)->first();
    $check = $request->all();
    $datas = Auth::guard('web')->attempt(['user_id' => $check['user_id'], 'password' => $check['password'], 'status' => 1]);
    if (!$datas) {
      return back()->with('message', 'Something Went Wrong! ');
    } else {
      if (Auth::guard('web')->attempt(['user_id' => $check['user_id'], 'password' => $check['password']])) {
        if ($IsManager->role_id == 1) {
          return redirect()->route('user.Profile')->with('message', 'Manager Login Successfully');
        } else {
          return redirect()->route('user.Profile')->with('message', 'User Login Successfully');
        }
      } else {
        return back()->with('message', 'Invalid Email or Password! ');
      }
    }
  }

  public function Profile()
  {
    return view('user.user_profile.index');
  }
}
