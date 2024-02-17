<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    
       // Report for Monthly Ecpense
       public function MonthlyExpense(){
        $monthly_expense = Expense::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.report.monthly_expenses', compact('monthly_expense'));
    }

       // Report for Monthly Ecpense
       public function YearlyExpense(){
        $yearly_expense = Expense::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.report.yearly_expenses', compact('yearly_expense'));
    }

       // Report for Monthly Ecpense
       public function MonthlyIncome(){
        $monthly_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
        return view('admin.report.monthly_incomes', compact('monthly_income'));
    }
       // Report for Monthly Ecpense
       public function YearlyIncome(){
        $yearly_income = Income::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('month', 'DESC')->get();
        return view('admin.report.yearly_incomes', compact('yearly_income'));
    }
}
