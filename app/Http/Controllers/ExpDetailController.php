<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exp_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExpDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $expDetails = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->orderBy('id', 'DESC')->get();
        // $expDetails = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
        // dd($expDetails);
        return view('admin.expense.exp_details.index', compact('expDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Create()
    {
        $exp_cat = Category::get();
        return view('admin.expense.exp_details.create', compact('exp_cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {

        $data['cat_id'] = $request->cat_id;
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['year'] = date('Y');
        $data['month'] = date('m');
        $data['amount'] = $request->amount;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        // dd($data);
       $exp = Exp_detail::create($data);

        if(!$exp){
            return redirect()->back()->with('message', 'Something went wrong');
        }
        return redirect()->route('expense-details.index')->with('message', 'Expense creted successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Exp_detail $exp_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exp_detail $exp_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exp_detail $exp_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exp_detail $exp_detail)
    {
        //
    }
}
