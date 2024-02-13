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
                                        <a href="{{ route('expense.store') }}" class="btn btn-outline-primary">Month ended</a>
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
                                        @foreach ($expDetails as $key => $item)
                                            @php
                                                $data = DB::table('categories')
                                                    ->where('id', $item->cat_id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->name }}</td>
                                                <td class="text-right">{{ $item->amount }}</td>
                                                <td class="text-center"><a href="{{route('expense.voucher', $item->id)}}" class="btn btn-sm btn-primary">Generate vouchar</a></td>
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
