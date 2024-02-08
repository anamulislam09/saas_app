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
                                        <h3 class="card-title">All Expenses</h3>
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
                                            <th class="d-none">Month</th>
                                            <th>Created By</th>
                                            <th>Expense</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($expDetails as $key => $item)
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

                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-none">{{ $item->year }}</td>
                                                <td class="d-none">
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

                                                @if ($user)
                                                    <td>{{ $userName->name }}</td>
                                                @elseif ($customer)
                                                    {{-- <td>{{ $customerName->name }}</td> --}}
                                                    <td><span class="badge badge-success">Admin</span></td>
                                                @endif
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $item->amount }}</td>
                                            </tr>
                                        @endforeach
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
