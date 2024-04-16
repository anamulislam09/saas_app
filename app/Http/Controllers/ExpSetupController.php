<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExpSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use Carbon\Carbon;

class ExpSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function ExpenseSetupIndex()
    {
        $expenses = Category::get();
        $data = ExpSetup::get();
        return view('admin.expense.expense-setup.index', compact('expenses', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ExpenseSetupCreate(Request $request)
    {
        // $data = $request->all();
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['exp_id'] = $request->exp_id;
        $data['start_date'] = date('Y-m-d');
        $data['interval_days'] = $request->days;
        // $data['end_date'] = $request->exp_id;
        // dd($data);
        ExpSetup::create($data);
        // $date = Carbon::createFromFormat('Y.m.d', $request->days);
        // $daysToAdd = 50;
        // $date = $date->addDays($daysToAdd);
        // dd($date);

        return Response::json(true, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpSetup $expSetup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpSetup $expSetup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExpSetup $expSetup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpSetup $expSetup)
    {
        //
    }
}
