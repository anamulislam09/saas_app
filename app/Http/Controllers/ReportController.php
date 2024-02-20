<?php

namespace App\Http\Controllers;

use App\Models\Exp_detail;
use App\Models\Expense;
use App\Models\Income;
use App\Models\OthersIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    // Report for Monthly Ecpense
    public function MonthlyExpense(Request $request)
    {
        return view('admin.report.monthly_expenses');
    }

    // Report for Monthly Ecpense
    public function MonthlyAllExpense(Request $request)
    {
        $isExist = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $request->month)->where('year', $request->year)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $monthly_expense = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $request->month)->where('year', $request->year)->groupBy('cat_id')->get();
            $months = Exp_detail::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();

            return redirect()->back()->with(['monthly_expense' => $monthly_expense, 'months' => $months]);
            // return view('admin.report.monthly_expenses', compact('monthly_expense','months'));
        }
    }

    // Report for yearly Ecpense
    public function YearlyExpense()
    {
        return view('admin.report.yearly_expenses');
    }

    // Report for yearly Ecpense
    public function YearlyAllExpense(Request $request)
    {
        $isExist = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('year', $request->year)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $yearly_expense = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('year', $request->year)->groupBy('cat_id')->get();
            $year = Exp_detail::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();

            return redirect()->back()->with(['yearly_expense' => $yearly_expense, 'year' => $year]);
        }
    }

    // Report for Monthly income
    public function MonthlyIncome()
    {
        // $monthly_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
        return view('admin.report.monthly_incomes');
    }

    public function MonthlyAllIncome(Request $request)
    {
        $isExist = Income::where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $monthly_income = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->sum('paid');
            $months = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
            $others_income = OthersIncome::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
            // dd($months);
            return redirect()->back()->with(['monthly_income' => $monthly_income, 'months' => $months, 'others_income' => $others_income]);
        }
    }
    // Report for Monthly income

    // Report for yearly income
    public function YearlyIncome()
    {
        return view('admin.report.yearly_incomes');
    }

    public function YearlyAllIncome(Request $request)
    {
        $isExist = Income::where('year', $request->year)->where('status', '!=', 0)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $yearly_income = Income::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->sum('paid');
            $year = Income::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
            $others_income = OthersIncome::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
            // dd($months);
            return redirect()->back()->with(['yearly_income' => $yearly_income, 'year' => $year, 'others_income' => $others_income]);
        }
    }
      // Report for yearly income
}
