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
                                        <form action="{{ route('income.store') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="" class="col-form-label">Select Year</label>
                                                    <select name="year" class="form-control" id="">
                                                        <option value="" selected disabled>Selece Once</option>
                                                        <option value="">2023</option>
                                                        <option value="">2024</option>
                                                        <option value="">2025</option>
                                                        <option value="">2026</option>
                                                        <option value="">2027</option>
                                                        <option value="">2028</option>
                                                        <option value="">2029</option>
                                                        <option value="">2030</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="col-form-label">Select Month</label>
                                                    <select name="month" class="form-control" id="">
                                                        <option value="" selected disabled>Selece Once</option>
                                                        <option value="">January</option>
                                                        <option value="">February</option>
                                                        <option value="">March</option>
                                                        <option value="">April</option>
                                                        <option value="">May</option>
                                                        <option value="">June</option>
                                                        <option value="">July</option>
                                                        <option value="">August</option>
                                                        <option value="">September</option>
                                                        <option value="">October</option>
                                                        <option value="">November</option>
                                                        <option value="">December</option>
                                                    </select>
                                                </div>
                                                <div class=" col-lg-12">
                                                    <input type="text" style="border: none" name="category_name"
                                                        class="col-form-label" value="Service Charge" tabindex="-1">
                                                </div>
                                                <div class="col-lg-12">
                                                    <input type="text" id="" class="form-control" name="amount"
                                                        placeholder="Enter amount">
                                                </div>
                                                <div class="col-lg-12 m-2">
                                                    <input type="submit" class="btn btn-primary" value="submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User </th>
                                            <th>amount</th>
                                            <th>Service</th>
                                            <th>due</th>
                                            <th style="width: 15%">pay</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->user_id }}</td>
                                                <td>{{ $item->user_name }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->income_category }}</td>
                                                <td>{{ $item->due }}</td>
                                                <td><input type="text" style="width:100%; border:none; border-radius:20px; text-align:center" placeholder="pay"></td>
                                                <td> <a href="" class="btn btn-sm btn-primary">Submit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
@endsection
