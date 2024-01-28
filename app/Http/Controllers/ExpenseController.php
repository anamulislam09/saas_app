<?php

namespace App\Http\Controllers;

use App\Models\Exp_detail;
use App\Models\Expense;
use Illuminate\Http\Request;
use Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
        $expense = Expense::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.expense.expense.index', compact('expense'));
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
    public function store(Request $request)
    {
        
        //Create an array
        $groups = [];
        
        //Retrieve the list of cat_id's in use.
        $expenses = Exp_detail::groupBy('cat_id')->get();
        // dd($expenses);
// $cats = DB::table('Products')->distinct()->select('cat_id')->get()

//for each cat_id in use, find the products associated and then add a collection of those products to the relevant array element
// foreach($cats as $cat){
//     $groups[$cat->cat_id] = DB::table('Products')->where('cat_id', $cat->cat_id)->get();
// }

        foreach($expenses as $expense){
            $data['year'] = $expense->year;
            $data['month'] = $expense->month;
            $data['cat_id'] = $expense->cat_id;

            $data['sub_total'] = Exp_detail::where('cat_id', $expense->cat_id)->SUM('amount')->get();
            $data['total'] = $expense->cat_id;

            $data['customer_id'] = $expense->customer_id;
            $data['auth_id'] = $expense->auth_id;
            Expense::create($data);
        }

        return redirect()->route('expenses.index')->with('message', 'Successfully Creted');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
