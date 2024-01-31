<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /*-------------------IncomeCategory start here--------------*/
    public function IncomeCategory(){
        return view('admin.income.category');
        
    }
    
    public function StoreIncomeCategory(Request $request){
        $data['customer_id'] = Auth::guard('admin')->user()->id;
        $data['name'] = $request->name;
        IncomeCategory::create($data);
        return redirect()->route('income.category')->with('message', 'successfully created' );
    }
    /*-------------------IncomeCategory ends here--------------*/

    /*-------------------Income start here--------------*/
    // generate bill 
    // public function billGenerate(){
    //     $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->get();
    //     return view('admin.income.index', compact( 'data'));
        
    // }

    public function Create(){
        // $data = IncomeCategory::where('customer_id', Auth::guard('admin')->user()->id)->get();
        $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->get();

        return view('admin.income.income', compact( 'data')); 
    }

    public function Store(Request $request){
        // $income_category = IncomeCategory::where('customer_id', Auth::guard('admin')->user()->id)->where('id', $request->cat_id)->get();
        // dd($income_category);
        $users = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // dd($users);
        for ($i = 0; $i < count($users) ; $i++) {
            Income::insert([
              'month' => $users[$i]->month,
              'year' => $users[$i]->year,
              'user_id' => $users[$i]->user_id,
              'customer_id' => $users[$i]->customer_id,
              'auth_id' => Auth::guard('admin')->user()->id,
              'user_name' => $users[$i]->name,
              'income_category' => $request->category_name,
              'amount' => $request->amount,
            ]);
        }

        // $data = IncomeCategory::where('customer_id', Auth::guard('admin')->user()->id)->get();
        // return view('admin.income.create'); 
    }
    /*-------------------Income ends here--------------*/
}
