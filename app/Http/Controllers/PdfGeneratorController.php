<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Exp_detail;
// use Barryvdh\DomPDF\PDF;
use PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PdfGeneratorController extends Controller
{
    public function Voucher($id){
        
        $exp = Exp_detail::where('id', $id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
    
        $customer = Customer::where('id', Auth::guard('admin')->user()->id)->first();
        $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();
        // dd($exp);
        $data = [
            'date' => date('m/d/Y'),
            'exp' => $exp,
            'customer' => $customer,
            'custDetails' => $custDetails,
        ];

        // dd($data);

        $pdf = PDF::loadView('admin.expense.voucher.index', $data);
        // dd($pdf);

        return $pdf-> download('sdl.pdf');
    }
}
