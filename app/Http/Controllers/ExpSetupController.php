<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ExpSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use Carbon\Carbon;
use DateTime;

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
        $date=Carbon::today();

        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['exp_id'] = $request->exp_id;
        $data['start_date'] = date('Y-m-d');
        $data['interval_days'] = $request->days;
        $data['end_date'] = $date->addDays($request->days)->toDateString();
        ExpSetup::create($data);
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
    public function ExpenseSetupEdit( $id)
    {
        $expenses = Category::get();
        $exp = ExpSetup::where('customer_id', Auth::guard('admin')->user()->id)->where('id',$id)->first();
        return view('admin.expense.expense-setup.edit', compact('expenses','exp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function ExpenseSetupUpdate(Request $request)
    {
        $id = $request->id;
        $date=Carbon::today();
        $exp = ExpSetup::where('customer_id', Auth::guard('admin')->user()->id)->where('id',$id)->first();

        $exp['start_date'] = date('Y-m-d');
        $exp['interval_days'] = $request->days;
        $exp['end_date'] = $date->addDays($request->days)->toDateString();
        $exp->save();
        return redirect()->route('expense.setup')->with('message', 'Schedule Setup Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpSetup $expSetup)
    {
        //
    }
}
