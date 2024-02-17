<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /*-------------------Income start here--------------*/

    public function Create()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.income.income', compact('data'));
    }

    // store income 
    public function Store(Request $request)
    {
        $isExists = Flat::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$isExists) {
            return redirect()->back()->with('message', 'Flat not found!');  // User has no exist
        } else {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            // User has exist
            if ($request->month > $month || $request->year > $year)  {
                return redirect()->back()->with('message', "OPS! It is not possible to add data for advance month. Please select the current month or year.");
            } else {
                if (($month - 1 == $request->month) && ($year == $request->year)) {
                    $previousData = Income::where('month', $request->month)->where('year', $request->year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
                    if ($previousData) {
                        return redirect()->back()->with('message', 'You have already created!');
                    } else {
                        $flats = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();

                        for ($i = 0; $i < count($flats); $i++) {
                            Income::insert([
                                'month' => $request->month,
                                'year' => $request->year,
                                'flat_id' => $flats[$i]->flat_unique_id,
                                'customer_id' => $flats[$i]->customer_id,
                                'auth_id' => Auth::guard('admin')->user()->id,
                                'flat_name' => $flats[$i]->flat_name,
                                'charge' => $flats[$i]->charge,
                                'amount' => $flats[$i]->amount,
                                'due' => $flats[$i]->amount,
                            ]);
                        }
                        return redirect()->back()->with('message', 'Service charge 1 added successfully');
                    }
                } elseif(($month - 1 == $request->month) || ($year != $request->year)) {
                    return redirect()->back()->with('message', "PLS, Select current year.");
                }else{
                     /*-------------------if previous year has data start here --------------*/
                if (($request->month == 1)) {
                    $month = $request->month;
                    $year = $request->year;
                    $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
                    if ($data) {
                        return redirect()->back()->with('message', 'You have already create!');
                    } else {
                        $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->exists();
                        if ($data) {
                            $lastYear = date('Y') - 1;
                            $lastmonth = 12;

                            $flats = Income::where('month', $lastmonth)->where('year', $lastYear)->where('customer_id', Auth::guard('admin')->user()->id)->get();
                            for ($i = 0; $i < count($flats); $i++) {
                                $previousMonthData = Income::where('month', $lastmonth)->where('year', $lastYear)->where('user_id', $flats[$i]->flat_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();

                                $income = Income::insert([
                                    'month' => $month,
                                    'year' => $year,
                                    'flat_id' => $flats[$i]->flat_unique_id,
                                    'customer_id' => $flats[$i]->customer_id,
                                    'auth_id' => Auth::guard('admin')->user()->id,
                                    'flat_name' => $flats[$i]->flat_name,
                                    'charge' => $flats[$i]->charge,
                                    'amount' => $flats[$i]->amount,
                                    'due' => $flats[$i]->amount + $previousMonthData->due,
                                ]);
                            }

                            if ($income) {
                                return redirect()->back()->with('message', 'Service charge2 added successfully');
                            } else {
                                return redirect()->back()->with('message', 'something went wrong');
                            }
                        } else {
                            $flats = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
                            $month = $request->month;
                            $year = $request->year;

                            for ($i = 0; $i < count($flats); $i++) {
                                Income::insert([
                                    'month' => $month,
                                    'year' => $year,
                                    'flat_id' => $flats[$i]->flat_unique_id,
                                    'customer_id' => $flats[$i]->customer_id,
                                    'auth_id' => Auth::guard('admin')->user()->id,
                                    'flat_name' => $flats[$i]->flat_name,
                                    'charge' => $flats[$i]->charge,
                                    'amount' => $flats[$i]->amount,
                                    'due' => $flats[$i]->amount,
                                ]);
                            }
                            return redirect()->back()->with('message', 'Service charge3 added successfully');
                        }
                    }
                }
                             /*-------------------if previous year has data ends here --------------*/ 
                else {
                    $month = $request->month;
                    $year = $request->year;
                    $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->exists();
                    if ($data) {
                        return redirect()->back()->with('message', 'You have already create!');
                    } else {
                        $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->exists();
                        if ($data) {
                            $month = $request->month;
                            $year = $request->year;

                            $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . " -1 month")));
                            $flats = Income::where('month', $month - 1)->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->get();

                            for ($i = 0; $i < count($flats); $i++) {
                                $previousMonthData = Income::where('month', $month - 1)->where('year', $previousDate[0])->where('user_id', $flats[$i]->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
                                Income::insert([
                                    'month' => $month,
                                    'year' => $year,
                                    'flat_id' => $flats[$i]->flat_unique_id,
                                    'customer_id' => $flats[$i]->customer_id,
                                    'auth_id' => Auth::guard('admin')->user()->id,
                                    'flat_name' => $flats[$i]->flat_name,
                                    'charge' => $flats[$i]->charge,
                                    'amount' => $flats[$i]->amount,
                                    'due' => $flats[$i]->amount + $previousMonthData->due,
                                ]);
                            }
                            // dd($previousMonthData);
                            return redirect()->back()->with('message', 'Service charged4 added successfully');
                        } else {
                            $flats = Flat::where('customer_id', Auth::guard('admin')->user()->id)->get();
                            $month = $request->month;
                            $year = $request->year;

                            for ($i = 0; $i < count($flats); $i++) {
                                Income::insert([
                                    'month' => $month,
                                    'year' => $year,
                                    'flat_id' => $flats[$i]->flat_unique_id,
                                    'customer_id' => $flats[$i]->customer_id,
                                    'auth_id' => Auth::guard('admin')->user()->id,
                                    'flat_name' => $flats[$i]->flat_name,
                                    'charge' => $flats[$i]->charge,
                                    'amount' => $flats[$i]->amount,
                                    'due' => $flats[$i]->amount,
                                ]);
                            }
                            return redirect()->back()->with('message', 'Service5 charge5 added successfully');
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
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->get();
        return view('admin.income.collection', compact('data'));
    }

    public function StoreCollection(Request $request)
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $user_id = $request->user_id;
        $paid = $request->paid;
        $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->first();

        if ($paid > $data->due) {
            return redirect()->back()->with('message', 'Something went wrong!');
        } else {
            $data = Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->first();

            $item['paid'] = $paid;
            $item['due'] = $data->due - $paid;
            $item['status'] = 1;

            Income::where('month', $month)->where('year', $year)->where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->update($item);
            return redirect()->route('income.collection')->with('message', 'Collection successful');
        }
    }
    /*-------------------Collection ends here--------------*/
}
