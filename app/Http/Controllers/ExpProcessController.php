<?php

namespace App\Http\Controllers;

use App\Models\Exp_detail;
use App\Models\Exp_process;
use App\Models\Expense;
use App\Models\MonthlyBlance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        $data = Exp_process::where('customer_id', Auth::guard('admin')->user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.expense.expense.exp_process', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;    
 
        $expenses = Expense::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->groupBy('month')->get();

        foreach ($expenses as $expense) {
            $data['year'] = $expense->year;
            $data['month'] = $expense->month;
            $data['total'] = Expense::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $expense->month)->where('year', $expense->year)->SUM('sub_total');
            $data['customer_id'] = $expense->customer_id;
            $data['auth_id'] = $expense->auth_id;
            $exp_process = Exp_process::create($data);
        }


        if ($exp_process) {
            $month_exp = Exp_process::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->where('year', $year)->first();           
            // total income of this month
            $income = DB::table('incomes')
                ->where('month', $month)      
                ->where('year', $year)
                ->where('customer_id', Auth::guard('admin')->user()->id)
                ->SUM('paid');

            // oprning blance
            $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . ' -1 month')));

            $openingBlance = DB::table('monthly_blances')
                ->where('month', $month)
                ->where('year', $year)           
                ->where('customer_id', Auth::guard('admin')->user()->id)
                ->first();


            // oprning blance 

            if (!$openingBlance) {
                $balance = $income - $month_exp->total;
                

                $data['year'] = $month_exp->year;
                $data['month'] = $month_exp->month;
                $data['amount'] = $balance;
                $data['customer_id'] = $month_exp->customer_id;
                $data['auth_id'] = $month_exp->auth_id;
                if($balance >= 0){
                    $data['flag'] = 1;
                }else{
                    
                    $data['flag'] = 0;
                }
                $exp_process = MonthlyBlance::create($data);
            } else {
                if ($openingBlance->flag == 1) {
                    $balance = ($openingBlance->amount + $income) - $month_exp->total;

                    $data['year'] = $income->year;
                    $data['month'] = $income->month;
                    $data['amount'] = $balance;
                    $data['customer_id'] = $income->customer_id;
                    $data['auth_id'] = $income->auth_id;
                    if($balance >= 0){
                        $data['flag'] = 1;
                    }else{
                        
                        $data['flag'] = 0;
                    }
                    $exp_process = MonthlyBlance::create($data);
                } elseif($openingBlance->flag == 0) {
                    $balance = ($income - $openingBlance->amount) - $month_exp->total;

                    $data['year'] = $income->year;
                    $data['month'] = $income->month;
                    $data['amount'] = $balance;
                    $data['customer_id'] = $income->customer_id;
                    $data['auth_id'] = $income->auth_id;
                    if($balance >= 0){
                        $data['flag'] = 1;
                    }else{
                        
                        $data['flag'] = 0;
                    }
                    $exp_process = MonthlyBlance::create($data);
                }
            }
        }


        if ($exp_process) {
            return redirect()->route('expenses.process')->with('message', 'Expense store successfully');
        } else {
            return redirect()->back()->with('message', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exp_process $exp_process)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exp_process $exp_process)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exp_process $exp_process)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exp_process $exp_process)
    {
        //
    }
}
