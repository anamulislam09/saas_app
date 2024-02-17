@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-10 col-sm-12">
                                        <h3 class="card-title">Ladger Account</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('expense_process.store') }}"
                                            class="btn btn-sm btn-outline-primary">Ledger Posting</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Expense</th>
                                            <th>SubTotal</th>
                                            <th>Total Cost</th>
                                            <th>Income</th>
                                            <th>Blance</th>
                                    </thead>
                                    @php

                                        $month = Carbon\Carbon::now()->month;
                                        $year = Carbon\Carbon::now()->year;

                                        $total = App\Models\Expense::where('customer_id', Auth::guard('admin')->user()->id)
                                            ->where('month', $month)
                                            ->where('year', $year)
                                            ->groupBy('month')
                                            ->SUM('sub_total');

                                        // oprning blance of this year
                                        $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . ' -1 month')));

                                        $openingBlance = DB::table('monthly_blances')
                                            ->where('month', $month - 1)
                                            ->where('year', $previousDate[0])
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->first();

                                        // opening balannce of last year
                                        $lastYear = date('Y') - 1;
                                        $lastmonth = 12;

                                        $lastYopeningBlance = DB::table('monthly_blances')
                                            ->where('month', $lastmonth)
                                            ->where('year', $lastYear)
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->first();

                                        // total of this month
                                        $income = DB::table('incomes')
                                            ->where('month', $month)
                                            ->where('year', $year)
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->SUM('paid');

                                    @endphp
                                    <tbody>
                                        <tr>
                                            <td colspan="6" class="text-center"> <strong>Opening
                                                    Blance----------------></strong></td>
                                            @if ($month == 1)
                                                @if (!$lastYopeningBlance)
                                                    <td><strong>000</strong></td>
                                                @else
                                                    @if ($lastYopeningBlance->flag == 1)
                                                        <td><strong>{{ $lastYopeningBlance->amount }}</strong></td>
                                                    @else
                                                        <td><strong>-{{ $lastYopeningBlance->amount }}</strong></td>
                                                    @endif
                                                @endif
                                            @else
                                                @if (!$openingBlance)
                                                    <td><strong>000</strong></td>
                                                @else
                                                    @if ($openingBlance->flag == 1)
                                                        <td><strong>{{ $openingBlance->amount }}</strong></td>
                                                    @else
                                                        <td><strong>-{{ $openingBlance->amount }}</strong></td>
                                                    @endif
                                                @endif
                                            @endif


                                            <td></td>
                                        </tr>
                                        @if (!empty($expense))
                                            @foreach ($expense as $key => $item)
                                                @php
                                                    $data = DB::table('categories')
                                                        ->where('id', $item->cat_id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td style="border-right:1px solid #ddd">{{ $key + 1 }}</td>
                                                    <td>{{ $item->year }}</td>

                                                    <td>
                                                        @if ($item->month == 1)
                                                            January
                                                        @elseif ($item->month == 2)
                                                            February
                                                        @elseif ($item->month == 3)
                                                            March
                                                        @elseif ($item->month == 4)
                                                            April
                                                        @elseif ($item->month == 5)
                                                            May
                                                        @elseif ($item->month == 6)
                                                            June
                                                        @elseif ($item->month == 7)
                                                            July
                                                        @elseif ($item->month == 8)
                                                            August
                                                        @elseif ($item->month == 9)
                                                            September
                                                        @elseif ($item->month == 10)
                                                            October
                                                        @elseif ($item->month == 11)
                                                            November
                                                        @elseif ($item->month == 12)
                                                            December
                                                        @endif
                                                    </td>

                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $item->sub_total }}</td>
                                                    <td rowspan=""></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">NO Expense Available</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td colspan="5" class="text-center"><strong>Total cost of this month-------->
                                                </strong></td>
                                            <td><strong>{{ $total }}</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-center"><strong>Total income of this
                                                    month------------------------------> </strong></td>
                                            <td><strong>{{ $income }}</strong></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-center"><strong>Blance of this
                                                    month------------------------------------------------------------>
                                                </strong></td>
                                            <td>
                                                @if (!$openingBlance)
                                                    <strong
                                                        style="border-right:1px solid #ddd">{{ $income - $total }}</strong>
                                                @else
                                                    @if ($openingBlance->flag == 1)
                                                        <strong
                                                            style="border-right:1px solid #ddd">{{ $openingBlance->amount + $income - $total }}</strong>
                                                    @else
                                                        <strong
                                                            style="border-right:1px solid #ddd">{{ $income - $openingBlance->amount - $total }}</strong>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
