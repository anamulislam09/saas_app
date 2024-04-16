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
                                    <div class="col-lg-10 col-md-10 col-sm-12">
                                        <h3 class="card-title">Expense Setup</h3>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <a href="{{ route('expense.setup.create') }}" class="btn btn-outline-primary">Add
                                            Setup</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Exp Name</th>
                                            <th>Interval Days</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            @php
                                                $category = App\Models\Category::where('id', $item->exp_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->name}}</td>
                                                <td>{{ $item->interval_days}}</td>
                                                <td>{{ $item->start_date}}</td>
                                                <td>{{ $item->end_date}}</td>
                                                <td>
                                                    <span class="badge badge-primary">Done</span>
                                                    {{-- @if ($expense->start_date - )
                                                        <span class="badge badge-primary"></span>
                                                        @elseif ($expense->status == 1)
                                                        <span class="badge badge-primary"></span>
                                                        
                                                    @endif --}}
                                                
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
