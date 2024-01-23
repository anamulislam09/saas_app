@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <style>
        .table td,
        .table th {
            padding: 0.6rem;
        }
    </style>
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
                                        <h3 class="card-title">All Users</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('user.index') }}" class="btn btn-outline-primary">See Users
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <table id="dataTable" class="table table-bordered table-striped" style="width: 70%">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Flat name</th>
                                                    <th>User name</th>
                                                    <th>Phone</th>
                                                    <th>NID_no</th>
                                                    <th>Address</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->flat_name }}</td>
                                                        <td><input type="text" name="name"
                                                                style="width: 100px; border:none" placeholder="User name">
                                                        </td>
                                                        <td><input type="text" name="phone"
                                                                style="width: 100px ; border:none" placeholder="User phone">
                                                        </td>
                                                        <td><input type="text" name="nid_no"
                                                                style="width: 100px ; border:none"
                                                                placeholder="User NID No">
                                                        </td>
                                                        <td>
                                                            <textarea name="address" class="" style="width: 100px ; border:none" id="" cols="" rows="1"
                                                                placeholder="User Address"></textarea>
                                                        </td>
                                                        <td><input type="email" name="email"
                                                                style="width: 100px ; border:none" placeholder="User email">
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
                </div>
            </div>
        </section>
    </div>
@endsection
