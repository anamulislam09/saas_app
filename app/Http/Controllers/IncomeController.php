<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /*-------------------Income start here--------------*/

    public function Create()
    {
        return view('admin.income.income');
    }

    public function Store(Request $request)
    {
        $data = Income::where('month', date('m'))->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->exists();

        if ($data) {
            return redirect()->back()->with('message', 'You have already create!');
        } else {
            $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->exists();
            if ($data) {
                $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . " -1 month")));
                $users = Income::where('month', $previousDate[1])->where('year', $previousDate[0])->where('customer_id', Auth::guard('admin')->user()->id)->get();
                // dd($users);
                $month = $request->month;
                $year = $request->year;
                for ($i = 0; $i < count($users); $i++) {
                    $previousMonthData = Income::where('month', $previousDate[1])->where('year', $previousDate[0])->where('user_id', $users[$i]->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();

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
                return redirect()->route('income.collection')->with('message', 'Service charge added successfully');
            } else {
                $users = User::where('customer_id', Auth::guard('admin')->user()->id)->get();
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

                return redirect()->route('income.collection')->with('message', 'Service charge added successfully');;
            }
        }
    }
    /*-------------------Income ends here--------------*/

    /*-------------------Collection start here--------------*/
    public function Collection()
    {
        $data = Income::where('month', date('m'))->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->get();
        // $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->get();

        // $previousDate = explode('-',date('Y-m', strtotime(date('Y-m')." -1 month")));
        // foreach ($data as $key => $value) {
        //     $previousMonthData = Income::where('month',$previousDate[1])->where('year',$previousDate[0])->where('user_id',$value->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();
        //     if($previousMonthData){
        //         $data[$key]->due = $data[$key]->due + $previousMonthData->due;
        //     }
        // }

        return view('admin.income.income', compact('data'));
    }

    public function StoreCollection(Request $request)
    {
        $user_id = $request->user_id;
        $paid = $request->pay;

        // $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . " -1 month")));
        // $previousMonthData = Income::where('month', $previousDate[1])->where('year', $previousDate[0])->where('user_id', $users[$i]->user_id)->where('customer_id', Auth::guard('admin')->user()->id)->first();

        // $data = Income::where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->first();
        $data = Income::where('month', date('m'))->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->first();

        $item['paid'] = $paid;
        $item['due'] = $data->due - $paid;
        $item['status'] = 1;

        // Income::where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->update($item);
        Income::where('month', date('m'))->where('year', date('Y'))->where('customer_id', Auth::guard('admin')->user()->id)->where('user_id', $user_id)->update($item);
        return redirect()->route('income.collection')->with('message', 'Collection successful');;
    }
    /*-------------------Collection ends here--------------*/
}
