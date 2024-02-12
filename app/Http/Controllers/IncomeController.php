<?php

namespace App\Http\Controllers;

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
        $data = User::where('customer_id', Auth::guard('admin')->user()->id)->exists();
        if (!$data) {
            return redirect()->back()->with('message', 'User not found!');
        } else {
            /*-------------------if previous year has data start here --------------*/
            if ($request->month == 1) {
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

                        $users = Income::where('month', $lastmonth)->where('year', $lastYear)->where('customer_id', Auth::guard('admin')->user()->id)->get();
                        for ($i = 0; $i < count($users); $i++) {
                            $previousMonthData = Income::where('month', $lastmonth)->where('year', $lastYear)->where('user_id', $users[$i]->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();

                            $income = Income::insert([
                                'month' => $month,
                                'year' => $year,
                                'user_id' => $users[$i]->user_id,
                                'customer_id' => $users[$i]->customer_id,
                                'auth_id' => Auth::guard('admin')->user()->id,
                                'user_name' => $users[$i]->user_name,
                                'charge' => $users[$i]->charge,
                                'amount' => $users[$i]->amount,
                                'due' => $users[$i]->amount + $previousMonthData->due,
                            ]);
                        }
                        if ($income) {
                            return redirect()->back()->with('message', 'LAST MONTH  Service charge added successfully');
                        } else {
                            return redirect()->back()->with('message', 'some thing went wrong');
                        }
                    } else {
                        $users = User::where('customer_id', Auth::guard('admin')->user()->id)->where('status', 1)->get();
                        $month = $request->month;
                        $year = $request->year;

                        for ($i = 0; $i < count($users); $i++) {
                            Income::insert([
                                'month' => $month,
                                'year' => $year,
                                'user_id' => $users[$i]->user_id,
                                'customer_id' => $users[$i]->customer_id,
                                'auth_id' => Auth::guard('admin')->user()->id,
                                'user_name' => $users[$i]->name,
                                'charge' => $users[$i]->charge,
                                'amount' => $users[$i]->amount,
                                'due' => $users[$i]->amount,
                            ]);
                        }
                        return redirect()->back()->with('message', 'Service charge added successfully');
                    }
                }
            }/*-------------------if previous year has data ends here --------------*/ 
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
                        $users = Income::where('month', $month - 1)->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->get();

                        for ($i = 0; $i < count($users); $i++) {
                            $previousMonthData = Income::where('month', $month - 1)->where('year', $previousDate[0])->where('user_id', $users[$i]->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();

                            Income::insert([
                                'month' => $month,
                                'year' => $year,
                                'user_id' => $users[$i]->user_id,
                                'customer_id' => $users[$i]->customer_id,
                                'auth_id' => Auth::guard('admin')->user()->id,
                                'user_name' => $users[$i]->user_name,
                                'charge' => $users[$i]->charge,
                                'amount' => $users[$i]->amount,
                                'due' => $users[$i]->amount + $previousMonthData->due,
                            ]);
                        }
                        return redirect()->back()->with('message', 'Service charge added successfully');
                    } else {
                        $users = User::where('customer_id', Auth::guard('admin')->user()->id)->where('status', 1)->get();
                        $month = $request->month;
                        $year = $request->year;

                        for ($i = 0; $i < count($users); $i++) {
                            Income::insert([
                                'month' => $month,
                                'year' => $year,
                                'user_id' => $users[$i]->user_id,
                                'customer_id' => $users[$i]->customer_id,
                                'auth_id' => Auth::guard('admin')->user()->id,
                                'user_name' => $users[$i]->name,
                                'charge' => $users[$i]->charge,
                                'amount' => $users[$i]->amount,
                                'due' => $users[$i]->amount,
                            ]);
                        }
                        return redirect()->back()->with('message', 'Service charge added successfully');
                    }
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
