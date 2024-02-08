@extends('layouts.admin')

@section('admin_content')
    <style>
        input:focus {
            outline: none
        }

        .table td,
        .table th {
            padding: 0.4rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table tr td {
            text-align: center;
        }

        .table tr th {
            text-align: center;
        }
    </style>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-lg-12">
                                    <h3 class="card-title">Income Statement</h3>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th class="d-none">Year</th>
                                            <th class="d-none">Month</th>
                                            <th>Name</th>
                                            <th>Charge</th>
                                            <th>amount</th>
                                            <th>Collection</th>
                                            <th>Payble</th>
                                            <th>Created By</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)

                                        
                                            @php
                                                // $previousDate = explode('-', date('Y-m', strtotime(date('Y-m') . ' -1 month')));
                                                // $previousMonthData = App\Models\Income::where('month', $item->month - 1)
                                                //     ->where('year', $previousDate[0])
                                                //     ->where('user_id', $item->user_id)
                                                //     ->where('customer_id', Auth::guard('admin')->user()->id)
                                                //     ->first();

                                                // get user or customer name
                                                $user = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->exists();
                                                $userName = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->first();

                                                $customer = DB::table('customers')
                                                    ->where('id', $item->customer_id)
                                                    ->exists();

                                                $data = DB::table('categories')
                                                    ->where('id', $item->cat_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $item->user_id }}</td>
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
                                                <td>{{ $item->user_name }}</td>
                                                <td>{{ $item->charge }}</td>
                                                <td>{{ $item->amount }}</td>
                                                {{-- @if (!$previousMonthData)
                                                                <td >000</td>
                                                                @else
                                                                <td>{{ $previousMonthData->due }}</td>
                                                                @endif --}}
                                                <td>{{ $item->paid }}</td>
                                                <td>{{ $item->due }}</td>
                                                @if ($user)
                                                    <td>{{ $userName->name }}</td>
                                                @elseif ($customer)
                                                    {{-- <td>{{ $customerName->name }}</td> --}}
                                                    <td><span class="badge badge-success">Admin</span></td>
                                                @endif
                                                {{-- <td>
                                                @if ($item->status == 1)
                                                    <span class="badge badge-success">Paid</span>
                                                @else
                                                    <input type="submit" class="btn btn-sm btn-primary" value="Submit">
                                                @endif
                                            </td> --}}
                                            </tr>
                                        @endforeach
                                        {{-- </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script> --}}
@endsection
