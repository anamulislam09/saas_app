<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // show all customers 
    public function Index()
    {
        $data = Customer::all();
        if ($data->count() > 0) {
            return response()->json([
                'status' => 200,
                'products' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No data available'
            ], 404);
        }
    }

    // show single customer
    public function show($id)
    {
        $data = Customer::FindOrFail($id);
        if ($data->count() > 0) {
            return response()->json([
                'status' => 200,
                'products' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product !'
            ], 404);
        }
    }

    // customers create 
    public function AdminRegister(Request $request)
    {
        $customer = Customer::insert([

            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'customer_id' => $request->customer_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        if ($customer) {
            return response()->json([
                'status' => 200,
                'message' => 'Customer Register successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    // customer edit 

    public function edit($id)
    {
        $data = Customer::FindOrFail($id);
        if ($data->count() > 0) {
            return response()->json([
                'status' => 200,
                'products' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No such product !'
            ], 404);
        }
    }

    // customer update 
    public function update(Request $request)
    {

        $id = $request->id;

        $data = Customer::findOrFail($id);
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $data['customer_id'] = $request->customer_id;
        $data['status'] = $request->status;
        $data->save();

        if ($data) {
            return response()->json([
                'status' => 200,
                'message' => 'Customer Updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

       // delete single customer
    //    public function delete($id)
    //    {
    //        $data = Customer::FindOrFail($id);
    //        if ($data->count() > 0) {
    //            return response()->json([
    //                'status' => 200,
    //                'products' => $data
    //            ], 200);
    //        } else {
    //            return response()->json([
    //                'status' => 404,
    //                'Products' => 'No such product !'
    //            ], 404);
    //        }
    //    }


      // customers login 
      public function AdminLogin(Request $request)
      {
        $check = $request->all();
        if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return response()->json([
                'status' => 200,
                'message' => 'Login Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Invalid Email or Password!'
            ], 500);
           
        }
        //end method
      }
}
