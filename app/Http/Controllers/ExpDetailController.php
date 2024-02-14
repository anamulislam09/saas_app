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
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $expDetails = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->orderBy('id', 'DESC')->get();

        return view('admin.expense.exp_details.create', compact('exp_cat', 'expDetails'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function Store(Request $request)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $data['cat_id'] = $request->cat_id;
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['year'] = $year;
        $data['month'] = $month;
        $data['amount'] = $request->amount;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        // dd($data);
        $exp = Exp_detail::create($data);

        if (!$exp) {
            return redirect()->back()->with('message', 'Something went wrong');
        }
        return redirect()->back()->with('message', 'Expense creted successfully');
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
    public function Edit($id)
    {
        $data = Exp_detail::findOrFail($id);
        $exp_cat = Category::get();
        return view('admin.expense.exp_details.edit', compact('data', 'exp_cat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function Update(Request $request)
    {
        $id = $request->id;
        $data = Exp_detail::findOrFail($id);
        $data['cat_id'] = $request->cat_id;
        $data['amount'] = $request->amount;
        $data->save();
        return redirect()->back()->with('message', 'Expense updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function Delate($id)
    {
        $data = Exp_detail::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('message', 'Expense deleted successfully.');
    }


    // Report for Monthly Ecpense
    public function MonthlyExpense(){
        // dd('hello');
        $monthly_expense = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.report.monthly_expenses', compact('monthly_expense'));
    }
}
