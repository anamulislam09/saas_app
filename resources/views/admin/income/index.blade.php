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
                                <div class="card-header">
                                    <form action="" method="post">
                                    <div class="row">
                                        {{-- <label for=""> Select Income Category:</label> --}}
                                        <div class="col-lg-5 col-sm-12">
                                            <select name="cat_name" class="form-control" id="">
                                                <option value="" selected disabled> Selece Once</option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-sm-12">
                                            
                                            <input type="text" name="amount" class="form-control"
                                                placeholder="Enter amount">
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <input type="submit" class="btn btn-primary" value="submit">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">



                                {{-- <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Customer ID</th>
                                            <th>Flat Name</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
