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
                                        <h3 class="card-title">Balance Sheet month of
                                            @if (date('m') == 1)
                                                January
                                            @elseif (date('m') == 2)
                                                February
                                            @elseif (date('m') == 3)
                                                March
                                            @elseif (date('m') == 4)
                                                April
                                            @elseif (date('m') == 5)
                                                May
                                            @elseif (date('m') == 6)
                                                June
                                            @elseif (date('m') == 7)
                                                July
                                            @elseif (date('m') == 8)
                                                August
                                            @elseif (date('m') == 9)
                                                September
                                            @elseif (date('m') == 10)
                                                October
                                            @elseif (date('m') == 11)
                                                November
                                            @elseif (date('m') == 12)
                                                December
                                            @endif
                                        </h3>
                                    </div>
                                    {{-- <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('expense_process.store') }}"
                                            class="btn btn-sm btn-outline-primary">Ledger Posting</a>
                                    </div> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Total Income</th>
                                            <th class="text-center">Total expense</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Flag</th>
                                    </thead>
                                    <tbody>
                                        @if ($data)
                                        <tr>
                                            <td class="text-right">{{ $data->total_income }}</td>
                                            <td class="text-right">{{ $data->total_expense }}</td>
                                            <td class="text-right">{{ $data->amount }}</td>
                                            <td class="text-center">
                                                @if ($data->flag == 1)
                                                    <span class="badge badge-primary">Profit</span>
                                                @else
                                                    <span class="badge badge-danger">Loss</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @else
                                            
                                        @endif
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
