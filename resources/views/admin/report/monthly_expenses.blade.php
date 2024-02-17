@extends('layouts.admin')

@section('admin_content')
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
                                        <h3 class="card-title">Monthly Expenses</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th class="d-none">Year</th>
                                            <th>Month</th>
                                            <th class="text-center">Expense</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthly_expense as $key => $item)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->exists();
                                                $userName = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->first();

                                                $customer = DB::table('customers')
                                                    ->where('id', $item->customer_id)
                                                    ->exists();
                                                // $customerName = DB::table('customers')->where('id', $item->customer_id)->first();

                                                $data = DB::table('categories')
                                                    ->where('id', $item->cat_id)
                                                    ->first();

                                                // dd($customer);
                                                // Total amount
                                                // $total = App\Models\Exp_detail::where('customer_id', $item->customer_id)
                                                // ->where('month', $item->month)
                                                //      ->sum('amount');

                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-none">{{ $item->year }}</td>
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
                                                <td class="text-right">{{ $item->sub_total }}</td>
                                                @if ($user)
                                                    <td class="text-center">{{ $userName->name }}</td>
                                                @elseif ($customer)
                                                    {{-- <td>{{ $customerName->name }}</td> --}}
                                                    <td class="text-center"><span class="badge badge-success">Admin</span>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- @php
                                            // $total  = '';
                                                $total += $total+ $item->amount
                                            @endphp --}}
                                            @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{-- <tr>
                                            <td colspan="3"><strong>Total = </strong></td>
                                            <td>{{$total}}</td>
                                        </tr> --}}
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
