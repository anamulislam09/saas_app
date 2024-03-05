@extends('layouts.admin')

@section('admin_content')
    <style>
        input:focus {
            outline: none
        }
    </style>
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
                                    <div class="col-lg-12" style="border: 1px solid #ddd">
                                        <form action="{{ route('account.expense.all') }}" method="post">
                                            @csrf
                                            <div class="row my-4">
                                                <div class="col-lg-3">
                                                    <strong><span>Create voucher </span></strong>
                                                </div>
                                                <div class="col-lg-3">
                                                    {{-- <label for="" class="col-form-label">Select Year</label> --}}
                                                    <select name="year" class="form-control" id="" required>
                                                        <option value="" selected disabled>Select Year</option>
                                                        <option value="2023">Year 2023
                                                        </option>
                                                        <option value="2024">Year 2024
                                                        </option>
                                                        <option value="2025">Year 2025
                                                        </option>
                                                        <option value="2026">Year 2026
                                                        </option>
                                                        <option value="2027">Year 2027
                                                        </option>
                                                        <option value="2028">Year 2028
                                                        </option>
                                                        <option value="2029">Year 2029
                                                        </option>
                                                        <option value="2030">Year 2030
                                                        </option>
                                                    </select>
                                                </div>
                                                {{-- 'month', date('m'))->where('year', date('Y') --}}
                                                <div class="col-lg-3">
                                                    {{-- <label for="" class="col-form-label">Select Month</label> --}}
                                                    <select name="month" class="form-control" id="" required>
                                                        <option value="" selected disabled>Select Month </option>
                                                        <option value="1">January
                                                        </option>
                                                        <option value="2">February
                                                        </option>
                                                        <option value="3">March
                                                        </option>
                                                        <option value="4">April
                                                        </option>
                                                        <option value="5">May</option>
                                                        <option value="6">June
                                                        </option>
                                                        <option value="7">July
                                                        </option>
                                                        <option value="8">August
                                                        </option>
                                                        <option value="9">September
                                                        </option>
                                                        <option value="10">October
                                                        </option>
                                                        <option value="11">November
                                                        </option>
                                                        <option value="12">December
                                                        </option>
                                                    </select>
                                                </div>

                                                {{-- @if (Route::current()->getName() == 'income.create') --}}
                                                <div class="col-lg-2">
                                                    <label for="" class="col-form-label"></label>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                                {{-- @else --}}
                                                {{-- @endif --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    $data = Session::get('data');
                                    $months = Session::get('months');
                                @endphp

                                @if (isset($data) && !empty($data))
                                    {{-- @php   
                    @foreach ($data as $key => $item)
                    $month = Ap\Models\Income::where('month', $item->month)->where('year', $item->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
                    @endforeach
             @endphp --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10">
                                                    <strong> Total expenses month of @if ($months->month == 1)
                                                            January
                                                        @elseif ($months->month == 2)
                                                            February
                                                        @elseif ($months->month == 3)
                                                            March
                                                        @elseif ($months->month == 4)
                                                            April
                                                        @elseif ($months->month == 5)
                                                            May
                                                        @elseif ($months->month == 6)
                                                            June
                                                        @elseif ($months->month == 7)
                                                            July
                                                        @elseif ($months->month == 8)
                                                            August
                                                        @elseif ($months->month == 9)
                                                            September
                                                        @elseif ($months->month == 10)
                                                            October
                                                        @elseif ($months->month == 11)
                                                            November
                                                        @elseif ($months->month == 12)
                                                            December
                                                        @endif </strong>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('account.expense.voucher.generateall') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="month" value="{{ $months->month }}">
                                                        <input type="hidden" name="year" value="{{ $months->year }}">

                                                        <label for="" class="col-form-label"></label>
                                                        <input type="submit" class="btn btn-info text-end"
                                                            value="Generate all">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="dataTable" class="table table-bordered table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%">SL</th>
                                                <th>Expense</th>
                                                <th style="width: 20%" class="text-right">Amount</th>
                                                {{-- <th style="width: 20%" class="text-center">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                @php
                                                    $data = DB::table('categories')
                                                        ->where('id', $item->cat_id)
                                                        ->first();
                                                    $sub_total = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                        ->where('month', $item->month)
                                                        ->where('year', $item->year)
                                                        ->where('cat_id', $item->cat_id)
                                                        ->sum('amount');
                                                    $total = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                        ->where('month', $item->month)
                                                        ->where('year', $item->year)
                                                        ->sum('amount');
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td class="text-right">
                                                        {{ $sub_total }}
                                                    </td>
                                                    {{-- <td class="text-center"><a href="#" class="btn btn-sm btn-info">Voucher</a>
                          </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"> <strong>Total :</strong></td>
                                                <td class="text-right"><strong>{{ $total }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @else
                                    {{-- @php
                                        $month = Carbon\Carbon::now()->month;
                                        $year = Carbon\Carbon::now()->year;
                                    @endphp --}}
                                    @if (isset($month->month) && !empty($month->month))
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-10">
                                                    <strong> Total expenses month of @if ($month->month == 1)
                                                            January
                                                        @elseif ($month->month == 2)
                                                            February
                                                        @elseif ($month->month == 3)
                                                            March
                                                        @elseif ($month->month == 4)
                                                            April
                                                        @elseif ($month->month == 5)
                                                            May
                                                        @elseif ($month->month == 6)
                                                            June
                                                        @elseif ($month->month == 7)
                                                            July
                                                        @elseif ($month->month == 8)
                                                            August
                                                        @elseif ($month->month == 9)
                                                            September
                                                        @elseif ($month->month == 10)
                                                            October
                                                        @elseif ($month->month == 11)
                                                            November
                                                        @elseif ($month->month == 12)
                                                            December
                                                        @endif </strong>
                                                </div>
                                                <div class="col-2">
                                                    <form action="{{ route('account.expense.voucher.generateall') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="month" value="{{ $month->month }}">
                                                        <input type="hidden" name="year" value="{{ $month->year }}">

                                                        <label for="" class="col-form-label"></label>
                                                        <input type="submit" class="btn btn-info text-end"
                                                            value="Generate all">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="dataTable" class="table table-bordered table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%">SL</th>
                                                <th>Expense</th>
                                                <th style="width: 20%" class="text-right">Amount</th>
                                                {{-- <th style="width: 20%" class="text-center">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($exp as $key => $exp_item)
                                                @php
                                                    $data = DB::table('categories')
                                                        ->where('id', $exp_item->cat_id)
                                                        ->first();
                                                    $sub_total = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                        ->where('month', $exp_item->month)
                                                        ->where('year', $exp_item->year)
                                                        ->where('cat_id', $exp_item->cat_id)
                                                        ->sum('amount');
                                                    $total = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                        ->where('month', $exp_item->month)
                                                        ->where('year', $exp_item->year)
                                                        ->sum('amount');
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td class="text-right">
                                                        {{ $sub_total }}
                                                    </td>
                                                    {{-- <td class="text-center"><a href="#" class="btn btn-sm btn-info">Voucher</a>
                        </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"> <strong>Total :</strong></td>
                                                <td class="text-right"><strong>{{ $total }}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    @else
                                        
                                    <h5 class="text-center py-3">No Data Found</h5>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit USer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="modal_body">

                </div>

            </div>
        </div>
    </div>


    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
@endsection
