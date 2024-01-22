<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;
use Yajra\DataTables\Facades\DataTables;

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
            return redirect()->route('admin.dashboard')->with('message', 'Login Successfully');
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

        // $id = UniqueIdGenerator::generate(['table' => 'customers', 'length' => 4]);
        $start_at = 1001;

        if ($start_at) {
            $customer = Customer::find($start_at);
            if (!$customer) {
                $data['id'] = $start_at;
            }
        }

        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['nid_no'] = $request->nid_no;
        $data['image'] = $request->image;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        // dd($data);

        $customer = Customer::create($data);
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
    // register method ends here

    /*-------------------Customers related method start here--------------*/
    public function Customer(Request $request)
    {
        // $data = Customer::where('role' == 1)->orderBy('id', 'DESC');
        // dd($data);
        // if ($request->ajax()) {
        //     $data = "";


        //     if ($request->status == 0) {
        //         $query->where('status', 0);
        //     } elseif ($request->status == 1) {
        //         $query->where('status', 1);
        //     }
        //     $data = $query->get();
        //    dd($data);
        //     return DataTables::of($data)
        //         ->addIndexColumn()
        //         //status column start here
        //         ->editColumn('status', function ($row) {
        //             if ($row->status == 0) {
        //                 return ' <span class="badge badge-danger">Inactive</span>';
        //             } elseif ($row->status == 1) {
        //                 return ' <span class="badge badge-primary" >Active</span>';
        //             } 
        //         })       
        //           //status column ends here

        //         //role column start here
        //         ->editColumn('role', function ($row) {
        //             if ($row->role == 0) {
        //                 return ' <span class="badge badge-primary">SuperAdmin</span>';
        //             } elseif ($row->role == 1) {
        //                 return ' <span class="badge badge-info" >Customer</span>';
        //             } 
        //         })       
        //           //role column ends here

        //         ->addColumn('action', function ($row) {
        //             $actionbtn = '
        //             <a href="" class="btn btn-sm btn-primary" ><i class="fas fa-eye"></i></a> 
        //             <a href="#" class="btn btn-sm btn-info edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editOrderModel"><i class="fas fa-edit"></i></a>
        //             ';
        //             return $actionbtn;
        //         })
        //         ->rawColumns(['action', 'role', 'status'])
        //         ->make(true);
        // }

        if (Auth::guard('admin')->user()->role == 0) {
        // if (auth()->user()->role == 1) {
            $data = Customer::all();
            // dd(Auth::check('role' == 0))
            return view('superadmin.customers.index', compact('data'));
        } else {
            $notification = array('message' => 'You have no permission.', 'alert_type' => 'warning');
            return redirect()->back()->with($notification);
        }
        //end method
    }

    // CustomerEdit edit 
    public function CustomerEdit($id)
    {
        if (Auth::guard('admin')->user()->role == 0) {
            $data = Customer::findOrFail($id);
            return view('superadmin.customers.edit', compact('data'));
        } else {
            $notification = array('message' => 'You have no permission.', 'alert_type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }

    // Customer update 
    public function CustomerUpdate(Request $request)
    {
        if (Auth::guard('admin')->user()->role == 0) {
        $data = array();
        $data['status'] = $request->status;
        DB::table('customers')->where('id', $request->id)->update($data);

        $notification = array('message' => 'Customer status update successfully.', 'alert_type' => 'warning');
        return redirect()->route('customers.all')->with($notification);
         } else {
            $notification = array('message' => 'You have no permission.', 'alert_type' => 'warning');
            return redirect()->back()->with($notification);
        }

    }

    /*-------------------Customers related method start here--------------*/
}
