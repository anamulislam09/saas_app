<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
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
        $isExist = Expense::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $monthly_expense = Expense::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
            $months = Expense::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
  
            return redirect()->back()->with(['monthly_expense'=>$monthly_expense,'months'=>$months]);
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
        $isExist = Expense::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $yearly_expense = Expense::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
            $year = Expense::where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
  
            return redirect()->back()->with(['yearly_expense'=>$yearly_expense,'year'=>$year]);
            // return view('admin.report.monthly_expenses', compact('monthly_expense','months'));
        }
    }

    // Report for Monthly Ecpense
    public function MonthlyIncome()
    {
        $monthly_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
        return view('admin.report.monthly_incomes', compact('monthly_income'));
    }
    // Report for Monthly Ecpense
    public function YearlyIncome()
    {
        $yearly_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
        return view('admin.report.yearly_incomes', compact('yearly_income'));
    }
}
