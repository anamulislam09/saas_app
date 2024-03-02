<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDetail;
use App\Models\Flat;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function Create()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->get();
        return view('user.income.income', compact('data'));
    }

    // store income 
    public function Store(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $isExists = Flat::where('customer_id', $user->customer_id)->exists();
        if (!$isExists) {
            return redirect()->back()->with('message', 'Flat not found!');  // User has no exist
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            // User has exist
            if ($request->month > $month || $request->year > $year) {
                return redirect()->back()->with('message', "OPS! It is not possible to add data for advance month. Please select the current month or year.");
            } else {
                if (($month - 1 == $request->month) && ($year == $request->year)) {
                    $previousData = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', $user->customer_id)->exists();
                    if ($previousData) {
                        return redirect()->back()->with('message', 'You have already created!');
                    } else {
                        $flats = Flat::where('customer_id', $user->customer_id)->get();

                        for ($i = 0; $i < count($flats); $i++) {
                            Income::insert([
                                'month' => $request->month,
                                'year' => $request->year,
                                'flat_id' => $flats[$i]->flat_unique_id,
                                'customer_id' => $flats[$i]->customer_id,
                                'auth_id' => $user->user_id,
                                'flat_name' => $flats[$i]->flat_name,
                                'charge' => $flats[$i]->charge,
                                'amount' => $flats[$i]->amount,
                                'due' => $flats[$i]->amount,
                            ]);
                        }
                        return redirect()->back()->with('message', 'Service charge added successfully');
                    }
                } elseif (($month - 1 == $request->month) || ($year != $request->year)) {
                    return redirect()->back()->with('message', "PLS, Select current year.");
                } else {
                    /*-------------------if previous year has data start here --------------*/
                    if (($request->month == 1)) {
                        $month = $request->month;
                        $year = $request->year;
                        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->exists();
                        if ($data) {
                            return redirect()->back()->with('message', 'You have already create!');
                        } else {
                            $data = Income::where('customer_id', $user->customer_id)->exists();
                            if ($data) {
                                $lastYear = date('Y') - 1;
                                $lastmonth = 12;

                                $flats = Income::where('month', $lastmonth)->where('year', $lastYear)->where('customer_id', $user->customer_id)->get();
                                for ($i = 0; $i < count($flats); $i++) {
                                    $previousMonthData = Income::where('month', $lastmonth)->where('year', $lastYear)->where('user_id', $flats[$i]->flat_id)->where('customer_id', $user->customer_id)->first();

                                    $income = Income::insert([
                                        'month' => $month,
                                        'year' => $year,
                                        'flat_id' => $flats[$i]->flat_unique_id,
                                        'customer_id' => $flats[$i]->customer_id,
                                        'auth_id' => $user->user_id,
                                        'flat_name' => $flats[$i]->flat_name,
                                        'charge' => $flats[$i]->charge,
                                        'amount' => $flats[$i]->amount,
                                        'due' => $flats[$i]->amount + $previousMonthData->due,
                                    ]);
                                }

                                if ($income) {
                                    return redirect()->back()->with('message', 'Service charge added successfully');
                                } else {
                                    return redirect()->back()->with('message', 'something went wrong');
                                }
                            } else {
                                $flats = Flat::where('customer_id', $user->customer_id)->get();
                                $month = $request->month;
                                $year = $request->year;

                                for ($i = 0; $i < count($flats); $i++) {
                                    Income::insert([
                                        'month' => $month,
                                        'year' => $year,
                                        'flat_id' => $flats[$i]->flat_unique_id,
                                        'customer_id' => $flats[$i]->customer_id,
                                        'auth_id' => $user->user_id,
                                        'flat_name' => $flats[$i]->flat_name,
                                        'charge' => $flats[$i]->charge,
                                        'amount' => $flats[$i]->amount,
                                        'due' => $flats[$i]->amount,
                                    ]);
                                }
                                return redirect()->back()->with('message', 'Service charge added successfully');
                            }
                        }
                    }
                    /*-------------------if previous year has data ends here --------------*/ else {
                        $month = $request->month;
                        $year = $request->year;
                        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->exists();
                        if ($data) {
                            return redirect()->back()->with('message', 'You have already create!');
                        } else {
                            $data = Income::where('customer_id', $user->customer_id)->exists();
                            if ($data) {
                                $month = $request->month;
                                $year = $request->year;

                                $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . " -1 month")));
                                $flats = Income::where('month', $month - 1)->where('year', date('Y'))->where('customer_id', $user->customer_id)->get();

                                for ($i = 0; $i < count($flats); $i++) {
                                    $previousMonthData = Income::where('month', $month - 1)->where('year', $previousDate[0])->where('flat_id', $flats[$i]->flat_id)->where('customer_id', $user->customer_id)->first();
                                    Income::insert([
                                        'month' => $month,
                                        'year' => $year,
                                        'flat_id' => $flats[$i]->flat_id,
                                        'customer_id' => $flats[$i]->customer_id,
                                        'auth_id' => $user->user_id,
                                        'flat_name' => $flats[$i]->flat_name,
                                        'charge' => $flats[$i]->charge,
                                        'amount' => $flats[$i]->amount,
                                        'due' => $flats[$i]->amount + $previousMonthData->due,
                                    ]);
                                }
                                // dd($previousMonthData);
                                return redirect()->back()->with('message', 'Service charged added successfully');
                            } else {
                                $flats = Flat::where('customer_id', $user->customer_id)->get();
                                $month = $request->month;
                                $year = $request->year;

                                for ($i = 0; $i < count($flats); $i++) {
                                    Income::insert([
                                        'month' => $month,
                                        'year' => $year,
                                        'flat_id' => $flats[$i]->flat_unique_id,
                                        'customer_id' => $flats[$i]->customer_id,
                                        'auth_id' => $user->user_id,
                                        'flat_name' => $flats[$i]->flat_name,
                                        'charge' => $flats[$i]->charge,
                                        'amount' => $flats[$i]->amount,
                                        'due' => $flats[$i]->amount,
                                    ]);
                                }
                                return redirect()->back()->with('message', 'Service5 charge added successfully');
                            }
                        }
                    }
                    // return redirect()->back()->with('message', 'Pls! Select Current Year!');
                }
            }
        }
    }
    /*-------------------Income ends here--------------*/


    /*-------------------Collection start here--------------*/
    public function Collection()
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->get();
        return view('user.income.collection', compact('data'));
    }

    public function StoreCollection(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $flat_id = $request->flat_id;
        $paid = $request->paid;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->where('flat_id', $flat_id)->first();

        if ($paid > $data->due) {
            return redirect()->back()->with('message', 'Something went wrong!');
        } else {

            $previousMonthData = Income::where('month', $month - 1)
                ->where('year', $year)
                ->where('flat_id', $flat_id)
                ->where('customer_id', $user->customer_id)
                ->first();
            $data = Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->where('flat_id', $flat_id)->first();
            if (isset($previousMonthData->due)) {
                $amount = $previousMonthData->due + $data->amount;

                $item['paid'] = $paid;
                $item['due'] = $data->due - $paid;
                if ($amount == $paid) {
                    $item['status'] = 1;
                } else {
                    $item['status'] = 2;
                }
            } else {
                $amount = $data->amount;

                $item['paid'] = $paid;
                $item['due'] = $data->due - $paid;
                if ($amount == $paid) {
                    $item['status'] = 1;
                } else {
                    $item['status'] = 2;
                }
            }

            Income::where('month', $month)->where('year', $year)->where('customer_id', $user->customer_id)->where('flat_id', $flat_id)->update($item);
            return redirect()->route('manager.income.collection')->with('message', 'Collection successful');
        }
    }
    /*-------------------Collection ends here--------------*/

    /*-------------------Collection voucher start here--------------*/

    public function Index()
    {   //show voucher page
        return view('user.income.collection_voucher');
    }

    public function CollectionAll(Request $request)
    { // show collection 

        $user = User::where('user_id', Auth::user()->user_id)->first();
        $isExist = Income::where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->where('customer_id', $user->customer_id)->exists();
        if (!$isExist) {
            return redirect()->back()->with('message', 'Data Not Found');
        } else {
            $data = Income::where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->where('customer_id', $user->customer_id)->get();
            $months = Income::where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->where('customer_id', $user->customer_id)->first();

            return redirect()->back()->with(['data' => $data, 'months' => $months]);
        }
    }

    // Income Management generate income voucher 
    public function GenerateIncomeVoucher($id)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $inv = Income::where('customer_id', $user->customer_id)->where('id', $id)->first();
        $user = User::where('customer_id', $user->customer_id)->where('flat_id', $inv->flat_id)->first();
        $customer = Customer::where('id', $user->customer_id)->first();
        $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();

        $data = [
            'inv' => $inv,
            'user' => $user,
            'customer' => $customer,
            'custDetails' => $custDetails,
        ];
        $pdf = PDF::loadView('user.voucher.money_receipt', $data);
        return $pdf->download('sdl_collection.pdf');
    }

    // Income Management generate all income voucher 
    public function GenerateIncomeVoucherAll(Request $request)
    {
        $user = User::where('user_id', Auth::user()->user_id)->first();

        $inv = Income::where('customer_id', $user->customer_id)->where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->get();
        $month = Income::where('customer_id', $user->customer_id)->where('month', $request->month)->where('year', $request->year)->where('status', '!=', 0)->first();
        // $user = User::where('customer_id', Auth::guard('admin')->user()->id)->where('flat_id', $inv->flat_id)->first();
        $customer = Customer::where('id', $user->customer_id)->first();
        $custDetails = CustomerDetail::where('customer_id', $customer->id)->first();

        $data = [
            'inv' => $inv,
            'month' => $month,
            'customer' => $customer,
            'custDetails' => $custDetails,
        ];
        // dd($data);
        $pdf = PDF::loadView('user.voucher.money_receipt_all', $data);
        return $pdf->download('sdl_collection.pdf');
    }
    // Income Management generate all income voucher 


    /*-------------------Collection voucher ends here--------------*/
}