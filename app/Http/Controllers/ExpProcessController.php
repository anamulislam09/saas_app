<?php

namespace App\Http\Controllers;

use App\Models\Exp_detail;
use App\Models\Exp_process;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $expenses = Expense::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month)->groupBy('month')->get();
        // dd($expense);

        foreach ($expenses as $expense) {
            $data['year'] = $expense->year;
            $data['month'] = $expense->month;
            $data['total'] = Expense::where('month', $expense->month)->where('month', $month)->SUM('sub_total');
            $data['customer_id'] = $expense->customer_id;
            $data['auth_id'] = $expense->auth_id;
            $exp_process = Exp_process::create($data);
        }

        if ($exp_process) {
           return redirect()->route('expenses.process')->with('message', 'Expense store successfully');
        }else{
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
