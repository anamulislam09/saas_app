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
                                        <h3 class="card-title">Expense Details</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('expense-summary.store') }}" class="btn btn-outline-primary">Month
                                            ended</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SL</th>
                                            <th class="text-center">Expense</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($expSummary as $key => $item)
                                            @php
                                                $data = DB::table('categories')
                                                    ->where('id', $item->cat_id)
                                                    ->first();
                                                $amount = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                    ->where('month', $item->month)
                                                    ->where('year', $item->year)
                                                    ->where('cat_id', $item->cat_id)
                                                    ->sum('amount');
                                                // dd($amount);

                                                $total = App\Models\Exp_detail::where('customer_id', Auth::guard('admin')->user()->id)
                                                    ->where('month', $item->month)
                                                    ->where('year', $item->year)
                                                    ->sum('amount');
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td class="text-right">{{ $amount }}</td>
                                                <td class="text-center">
                                                    {{-- <a href="{{ route('expense.voucher', $item->id) }}"
                            class="btn btn-sm btn-primary">General vouchar</a> --}}
                                                    <a href="" class="btn btn-sm btn-info text-center edit"
                                                        data-id="{{ $item->id }}" data-toggle="modal"
                                                        data-target="#editUser">General vouchar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-right"> <strong>Total :</strong></td>
                                            <td class="text-right"><strong>{{ $total }}</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
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
                    <form action="{{ route('expense.voucher',$item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id}}">
                        <div class="modal-body">
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label"> Name :</label>
                                <input type="text" class="form-control" value="" name="name">
                            </div>

                            <div class="mb-3 mt-3">
                                <label for="" class="form-label"> Email :</label>
                                <input type="email" class="form-control" value="" name="email">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label"> Phone :</label>
                                <input type="text" class="form-control" value="" name="phone">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="" class="form-label"> Address :</label>
                                <input type="text" class="form-control" value="" name="address">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
@endsection
