<?php

namespace App\Http\Controllers;

use App\Models\Exp_detail;
use App\Models\Exp_process;
use App\Models\Income;
use App\Models\MonthlyBlance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function Index()
    {   //show voucher page
        return view('admin.income.collection_voucher');
    }

    public function CollectionAll(Request $request)
    { // show collection 
        $isExist = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $data = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
            $months = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
            //    dd($month->month);
            // return view('admin.income.collection_voucher', compact('data', 'months'));
            return redirect()->back()->with(['data'=>$data,'months'=>$months]);
        }
    }

    //show voucher page
    public function ExpenseIndex()
    {
        return view('admin.accounts.expense_voucher');
    }

    // show collection 
    public function ExpenseAll(Request $request)
    {
        $isExist = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $request->month)->where('year', $request->year)->groupBy('cat_id')->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $data = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $request->month)->where('year', $request->year)->groupBy('cat_id')->get();
            $months = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $request->month)->where('year', $request->year)->groupBy('cat_id')->first();
            //    dd($month->month);
            // return view('admin.accounts.expense_voucher', compact('data', 'months'));
            return redirect()->back()->with(['data'=>$data,'months'=>$months]);
        }
    }

    // BalanceSheet
    public function BalanceSheet()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = MonthlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->first();
        // $total_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->sum('paid');
        return view('admin.accounts.balance_sheet', compact('data'));
    }

     // Expense rreport 
     public function Incomes()
     {
         $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
         return view('admin.accounts.incomes', compact('data'));
     }
}
