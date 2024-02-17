<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Exp_detail;
use App\Models\Exp_process;
use App\Models\Income;
use App\Models\MonthlyBlance;
use App\Models\OpeningBalance;
use App\Models\User;
use App\Models\YearlyBlance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlanceController extends Controller
{
    // OpeningBalance
    public function OpeningBalance()
    {
        // $data = MonthlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.accounts.opening_balance');
    }

    // OpeningBalanceStore
    public function OpeningBalanceStore(Request $request)
    {
        $isExist = OpeningBalance::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if ($isExist) {
            return redirect()->back()->with('message', 'You have already created opening balance.');
        } else {
           $balance = $request->income - $request->expense;

            $data['customer_id'] = Auth::guard('admin')->user()->id;
            $data['auth_id'] = Auth::guard('admin')->user()->id;
            $data['year'] = $request->year;
            $data['month'] = $request->month;
            $data['income'] = $request->income;
            $data['expense'] = $request->expense;
            if($request->income > $request->expense){
                $data['balance']  = $request->income - $request->expense;
            }else{
                $data['balance'] = $request->expense - $request->income;
            }

            $data['entry_datetime'] = date('Y-m-d H:i:s');
            if ($balance >= 0) {
                $data['flag'] = 1;
            } else {

                $data['flag'] = 0;
            }
            $Obalance = OpeningBalance::create($data);
            return redirect()->back()->with('message', 'Opening Balance Added Successfully');
        }
    }

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
    // public function Expenses()
    // {
    //     $expDetails = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
    //     return view('admin.report.expenses', compact('expDetails'));
    // }

   
}
