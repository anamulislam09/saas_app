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
                                        <h3 class="card-title">Create Exp_Details</h3>
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <a href="{{route('expense-details.index')}}" class="btn btn-sm btn-outline-primary">See All</a>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                               <div class="row">
                                <div class="col-12 m-auto border p-5">
                                    <form action="{{ route('expense-details.store') }}" method="POST">
                                        @csrf
                                            <div class=" form-group">
                                                <label for="floor" class="">Month :</label>
                                                <select name="month" class="form-control" id="">
                                                    <option value="" selected disabled>Select Once</option>
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="unit" class="">Expense Category :</label>
                                                <select name="cat_id" class="form-control" id="" required>
                                                    <option value="" selected disabled>Select Once</option>
                                                        @foreach ($exp_cat as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                        @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="unit" class="">Expense amount:</label>
                                                   <input type="text" name="amount" class="form-control" placeholder="Enter Expense Amount" required>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn btn-sm btn-primary float-end"
                                                    id="">Submit</button>
                                            </div>
                                    </form>
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
