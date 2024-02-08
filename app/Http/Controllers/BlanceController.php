<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Exp_detail;
use App\Models\Exp_process;
use App\Models\Income;
use App\Models\MonthlyBlance;
use App\Models\User;
use App\Models\YearlyBlance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlanceController extends Controller
{
    // Monthly blance 
    public function Monthly()
    {
        $data = MonthlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.blances.month', compact('data'));
    }

    // yearly blance 
    public function Yearly()
    {
        $data = YearlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.blances.year', compact('data'));
    }

    // Blance Sheet 
    public function BalanceSheet()
    {
        $data = MonthlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // $expense = Exp_process::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.report.balanceSheet', compact('data'));
    }

    // Expense rreport 
    public function Expenses()
    {
        $expDetails = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.report.expenses', compact('expDetails'));
    }

    // Expense rreport 
    public function Incomes()
    {
        $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.report.incomes', compact('data'));
    }
}
 