<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Index()
    {
      $data = User::all();
      return view('admin.users.index', compact('data'));
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
