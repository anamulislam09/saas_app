<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function Index(){
        return view('admin.income.collection_voucher');
    }
}
