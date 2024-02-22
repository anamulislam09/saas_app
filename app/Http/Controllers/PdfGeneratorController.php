<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Exp_detail;
use App\Models\Expense;
use App\Models\ExpenseVoucher;
// use Barryvdh\DomPDF\PDF;
use PDF;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use sirajcse\UniqueIdGenerator\UniqueIdGenerator;

class PdfGeneratorController extends Controller
{
    public function CreateVoucher($id)
    {
        $exp = Exp_detail::where('id', $id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
        return view('admin.expense.exp_details.receiver_info', compact('exp'));

    }
    public function GenerateVoucher(Request $request)
    {
        $exp = Exp_detail::where('id', $request->exp_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
        // $INV_id = UniqueIdGenerator::generate(['table' => 'expense_vouchers', 'length' => 4]);
        $id = UniqueIdGenerator::generate(['table' => 'expense_vouchers', 'length' => 10, 'prefix' =>'INV-']);
        // dd($id);
        $data['id'] = $id;
        $data['voucher_id'] = $id;
        $data['month'] = $exp->month;
        $data['year'] = $exp->year;
        $data['date'] = date('m/d/y');
        $data['customer_id'] = $exp->customer_id;
        $data['auth_id'] = Auth::guard('admin')->user()->id;
        $data['exp_id'] = $request->exp_id;
        $data['amount'] = $request->amount;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $voucher = ExpenseVoucher::create($data);
        if ($voucher) {
            $inv = ExpenseVoucher::where('customer_id', Auth::guard('admin')->user()->id)->latest()->first();
            $exp_name = Category::where('id', $inv->exp_id)->first();
            $customer = Customer::where('id', Auth::guard('admin')->user()->id)->first();
            $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();

            $data = [
                'inv' => $inv,
                'exp_name' => $exp_name,
                'customer' => $customer,
                'custDetails' => $custDetails,
            ];
            // dd($data);
            $pdf = PDF::loadView('admin.expense.voucher.index', $data);
            return $pdf->download('sdl.pdf');
            // return redirect()->back('expense.create')->$pdf->download('sdl.pdf');
        }
    }

    // generate all voucher 
    public function GenerateVoucherAll(){
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $inv = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month',$month)->where('year',$year)->groupBy('cat_id')->get();
        $total = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month',$month)->where('year',$year)->sum('amount');
        // $total = Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)->where('month', $month) ->where('year', $year)->sum('amount');
       
        $customer = Customer::where('id', Auth::guard('admin')->user()->id)->first();
        $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();

        $data = [
            'inv' => $inv,
            'total' => $total,
            'customer' => $customer,
            'custDetails' => $custDetails,
        ];
        $pdf = PDF::loadView('admin.expense.voucher.exp_all', $data);
        return $pdf->download('sdl.pdf');
    }
}
