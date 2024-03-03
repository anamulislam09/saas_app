@extends('user.user_layouts.user')

@section('user_content')
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
                                    {{-- @php
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
                                    </div> --}}

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                @php
                                $user = App\Models\User::where('user_id', Auth::user()->user_id)->first();
                                    $flat = App\Models\Flat::where('customer_id', $user->customer_id)->exists();
                                    $total = App\Models\Flat::where('customer_id', $user->customer_id)->sum('amount')
                                @endphp

                                @if (!$flat)
                                    <section class="page_404">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12 col-md-12 col-sm-12">
                                                    <div class="col-sm-12 text-center">
                                                        <div class="four_zero_four_bg">
                                                            <h1 class="text-center ">404</h1>
                                                        </div>
                                                        <div class="contant_box_404">
                                                            <h3 class="h2">
                                                                Flat Not Found!
                                                            </h3>
                                                            <p>Pls! Flat created first</p>
                                                            <a href="{{ route('users.index') }}" class="link_404 btn btn-primary">Create
                                                                Flat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @else
                                    <table id="dataTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">SL</th>
                                                <th class="text-center">Customer ID</th>
                                                <th class="text-center">Flat Name</th>
                                                <th class="text-center">Service Charge</th>
                                                <th class="text-center">Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->customer_id }}</td>
                                                    <td>{{ $item->flat_name }}</td>
                                                    <td class="text-right">{{ $item->amount }}</td>
                                                    <td class="text-center">
                                                        @if ($item->status == 1)
                                                            <span class="badge badge-primary">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Deactive</span>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                    <a href="{{ route('customer.edit', $item->id) }}"
                                                        class="btn btn-sm btn-info edit"><i class="fas fa-edit"></i></a>
                                                </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"> <strong>Total :</strong></td>
                                                <td class="text-right"><strong>{{$total}}</strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
