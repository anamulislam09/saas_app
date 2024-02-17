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
                                        <h3 class="card-title">Expenses</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        {{-- <a href="{{ route('expense_process.store')}}" class="btn btn-sm btn-outline-primary">Expense store</a> --}}
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
                                            <th>Amount</th>
                                            <th>Flag</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->year }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>
                                                    @if ($item->flag == 1)
                                                    <span class="badge badge-success">Profit</span>
                                                    @elseif ($item->flag == 0)
                                                    <span class="badge badge danger">Loss</span>
                                                    @endif
                                                </td>
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

