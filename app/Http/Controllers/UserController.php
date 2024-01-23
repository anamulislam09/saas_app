<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function Index()
    {
      $data = User::all();
      return view('admin.users.index', compact('data'));
        //end method
    }

    public function Create()
    {
      $data = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
      return view('admin.users.create', compact('data'));
        //end method
    }

    // edit method 
    public function Edit($id)
    {
      $data = User::where('id', $id)->first();
      $roles = Role::all();
      return view('admin.users.edit', compact('data', 'roles'));
        //end method
    }
}
