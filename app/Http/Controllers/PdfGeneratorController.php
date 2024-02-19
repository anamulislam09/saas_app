<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Exp_detail;
use App\Models\Expense;
// use Barryvdh\DomPDF\PDF;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfGeneratorController extends Controller
{
    public function Voucher($id){
        
        $exp = Expense::where('id', $id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
        $exp_name = Category::where('id', $exp->cat_id)->first();
    
        $customer = Customer::where('id', Auth::guard('admin')->user()->id)->first();
        $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();
        // dd($exp);
        $data = [
            'date' => date('m/d/Y'),
            'exp' => $exp,
            'exp_name' => $exp_name,
            'customer' => $customer,
            'custDetails' => $custDetails,
        ];

        $pdf = PDF::loadView('admin.expense.voucher.index', $data);
        return $pdf-> download('sdl.pdf');
    }
}
