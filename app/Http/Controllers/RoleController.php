<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }
}
