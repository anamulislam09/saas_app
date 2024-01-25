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
                                    <div class="col-lg-8 col-sm-12">
                                        <h3 class="card-title">All Flat</h3>
                                    </div>
                                    @php
                                        $isExist = DB::table('flats')
                                            ->where('customer_id', Auth::guard('admin')->user()->id)
                                            ->first();
                                    @endphp
                                    @if ($isExist)
                                        <div class="col-lg-2 col-sm-6">
                                            <a href="{{route('flat.singlecreate')}}" class="btn btn-sm btn-outline-primary">Add New</a>
                                        </div>
                                    @endif
                                    <div class="col-lg-2 col-sm-6">
                                        <a href="{{ !$isExist ? route('flat.create') : 'javascript:void(0)' }}"
                                            class="btn btn-sm btn-outline-primary">Flat Manage</a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Customer ID</th>
                                            <th>Flat Name</th>
                                            <th>Status</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->customer_id }}</td>
                                                <td>{{ $item->flat_name }}</td>
                                                <td>
                                                    @if ($item->status == 1)
                                                        <span class="badge badge-primary">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    <a href="{{ route('customer.edit', $item->id) }}"
                                                        class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></a>
                                                </td> --}}
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
