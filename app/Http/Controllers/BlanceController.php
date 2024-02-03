<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBlance;
use App\Models\YearlyBlance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlanceController extends Controller
{
    // Monthly blance 
    public function Monthly(){
        $data = MonthlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.blances.month', compact('data'));
    }

    // yearly blance 
    public function Yearly(){
        $data = YearlyBlance::where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.blances.year', compact('data'));
    }
}
