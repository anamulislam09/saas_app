@extends('layouts.admin')

@section('admin_content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <style>
        .table td,
        .table th {
            padding: 0.6rem;
        }


        /*======================
            404 page
        =======================*/


        .page_404 {
            padding: 40px 0;
            background: #fff;
            font-family: 'Arvo', serif;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {

            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 400px;
            background-position: center;
        }


        .four_zero_four_bg h1 {
            font-size: 80px;
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 10px 20px;
            background: #39ac31;
            margin: 20px 0;
            display: inline-block;
        }

        .contant_box_404 {
            margin-top: -50px;
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
                                        <h3 class="card-title">User Entry Form</h3>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">

                                        @php
                                            $data = App\Models\Flat::where('customer_id', Auth::guard('admin')->user()->id)
                                                ->where('status', 0)
                                                ->exists();
                                        @endphp

                                        @if (!$data)
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

                                                                    <p>Pls! Flat create first</p>

                                                                    <a href="{{route('users.index')}}" class="link_404">See Users</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        @else
                                            <table id="dataTable" class="table table-bordered table-striped"
                                                style="width: 70%">
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
                                                    <form action="{{ route('user.store') }}" method="POST">
                                                        @csrf
                                                        @foreach ($data as $key => $item)
                                                            {{-- <td><input type="hidden" name="customer_id" value="{{ $item->id }}"></td>
                                                <td><input type="hidden" name="customer_id" value="{{ $item->flat_name }}"></td> --}}
                                                            <tr>
                                                                <input type="hidden" name="flat_unique_id"
                                                                    value="{{ $item->flat_unique_id }}">
                                                                <input type="hidden" name="amount"
                                                                    value="{{ $item->amount }}">
                                                                <input type="hidden" name="charge"
                                                                    value="{{ $item->charge }}">
                                                                <input type="hidden" name="customer_id"
                                                                    value="{{ $item->customer_id }}">
                                                                <td>{{ $key + 1 }}</td>
                                                                <td><input type="text" name="flat_name"
                                                                        style="width: 50px; border:none" disabled
                                                                        value="{{ $item->flat_name }}"></td>
                                                                <td><input type="text" name="name"
                                                                        style="width: 140px; border:none"
                                                                        placeholder="User name" required>
                                                                </td>
                                                                <td><input type="text" name="phone"
                                                                        style="width: 140px ; border:none"
                                                                        placeholder="User phone" required>
                                                                </td>
                                                                <td><input type="text" name="nid_no"
                                                                        style="width: 140px ; border:none"
                                                                        placeholder="User NID No">
                                                                </td>
                                                                <td>
                                                                    <textarea name="address" class="" style="width: 140px ; border:none" id="" cols="" rows="1"
                                                                        placeholder="User Address"></textarea>
                                                                </td>
                                                                <td><input type="email" name="email"
                                                                        style="width: 140px ; border:none"
                                                                        placeholder="User email" required>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="submit" class="btn btn-primary"
                                                                    value="Submit"></td>
                                                        </tr>
                                                    </form>
                                                </tbody>
                                            </table>
                                        @endif
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
