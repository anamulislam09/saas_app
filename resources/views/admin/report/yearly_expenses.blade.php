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
                            <div class="card-header bg-primary text-center">
                                <h3 class="card-title pt-2" style="width:100%; text-align:center">Yearly Expenses </h3>
                            </div>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-12" style="border: 1px solid #ddd">
                                        <form action="{{ route('expensesall.year') }}" method="post">
                                            @csrf
                                            <div class="row my-4">
                                                <div class="col-lg-3">
                                                    <select name="year" class="form-control" id="year" required>
                                                        @foreach (range( date("Y"),2010) as $year)
                                                            <option value="{{ $year }}">{{ $year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label for="" class="col-form-label"></label>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    $yearly_expense = Session::get('yearly_expense');
                                    $year = Session::get('year');
                                @endphp
                                @if (isset($yearly_expense) && !empty($yearly_expense))
                                    {{-- @php   
                    @foreach ($data as $key => $item)
                    $month = Ap\Models\Income::where('month', $item->month)->where('year', $item->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
                    @endforeach
             @endphp --}}
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-9">
                                                    <strong> Total expenses year of {{ $year->year }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <table id="" class="table table-bordered table-striped mt-3">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%">SL</th>
                                                <th>Expense Head</th>
                                                <th style="width: 20%">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            @foreach ($yearly_expense as $key => $item)
                                                @php
                                                    $data = DB::table('categories')
                                                        ->where('id', $item->cat_id)
                                                        ->first();
                                                    $sub_total = App\Models\Exp_detail::where(
                                                        'customer_id',
                                                        Auth::guard('admin')->user()->id,
                                                    )
                                                        ->where('year', $item->year)
                                                        ->where('cat_id', $item->cat_id)
                                                        ->sum('amount');
                                                    $total = App\Models\Exp_detail::where(
                                                        'customer_id',
                                                        Auth::guard('admin')->user()->id,
                                                    )
                                                        ->where('year', $item->year)
                                                        ->sum('amount');
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td class="text-right">
                                                        {{ $sub_total }}
                                                    </td>

                                                    </td>
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
                                    @if (isset($years->year) && !empty($years->year))
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <strong> Total expenses year of {{ $years->year }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table id="" class="table table-bordered table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th style="width: 8%">SL</th>
                                                    <th>Expense Head</th>
                                                    <th style="width: 20%">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>



                                                @foreach ($yearly_exp as $key => $yearly_item)
                                                    @php
                                                        $data = DB::table('categories')
                                                            ->where('id', $yearly_item->cat_id)
                                                            ->first();
                                                        $sub_total = App\Models\Exp_detail::where(
                                                            'customer_id',
                                                            Auth::guard('admin')->user()->id,
                                                        )
                                                            ->where('year', $yearly_item->year)
                                                            ->where('cat_id', $yearly_item->cat_id)
                                                            ->sum('amount');
                                                        $total = App\Models\Exp_detail::where(
                                                            'customer_id',
                                                            Auth::guard('admin')->user()->id,
                                                        )
                                                            ->where('year', $yearly_item->year)
                                                            ->sum('amount');
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td>{{ $data->name }}</td>
                                                        <td class="text-right">
                                                            {{ $sub_total }}
                                                        </td>

                                                        </td>
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
