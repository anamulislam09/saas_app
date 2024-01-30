<?php

namespace App\Http\Controllers;

use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function IncomeCategory(){
        return view('admin.income.category');

    }

    public function StoreIncomeCategory(Request $request){
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['name'] = $request->name;
        IncomeCategory::create($data);
        return redirect()->route('income.category')->with('message', 'successfully created' );
    }

    public function billGenerate(){
        $data = IncomeCategory::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.income.index', compact( 'data'));

    }
}
