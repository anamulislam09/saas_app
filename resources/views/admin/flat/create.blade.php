@extends('layouts.admin')

@section('admin_content')
  <style>
    ul li {
      list-style: none;
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
              
              <div class="card-header bg-primary text-center">
                <h3 class="card-title pt-2" style="width:100%; text-align:center">Flat Manage </h3>
            </div>
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-8 col-sm-8 ">
                    {{-- {{$data}} --}}
                    @if (isset($flat) && count($flat))
                    <p class="mt-3 py-2 text-white text-center" style="background: #11d3a2;width:500px;border-radius:20px">Welcome, You have already created flat.</p>
                    @else
                    <h3 class="card-title pt-4 pb-4">Create New Flat</h3>
                    @endif
                  </div>

                  
                  @if (isset($flat) && count($flat))
                    <div class="col-lg-4 col-sm-4" style="border: 1px solid #ddd">
                      @php
                        $no_flat = App\Models\Flat::where('customer_id', Auth::guard('admin')->user()->id)->count();
                        $no_floor = App\Models\Flat::where('customer_id', Auth::guard('admin')->user()->id)->max('floor_no');
                        $data = App\Models\Flat::where('customer_id', Auth::guard('admin')->user()->id)->first();

                      @endphp
                      <ul>
                        <li>No of Flat:{{$no_flat}} </li>
                        <li>No of Floor:{{$no_floor}} </li>
                        <li>Service Charge: {{$data->amount}} tk</li>
                        <li>Created Date:  <span style="font-size: 16px"> ({{ date($data->create_date)}} {{$data->create_month}} {{$data->create_year}})</span></li>
                      </ul>
                    </div>
                    @else
                  @endif
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- /.card-header -->
                <div class="row py-4">
                  <div class="col-10 m-auto border p-5" style="background: #ddd">
                    <form action="{{ route('flat.store') }}" method="POST">
                      @csrf
                      <div class="row">
                        <div class="col-lg-6">
                          <div class=" form-group">
                            <label for="floor" class="">No of Floor :</label>
                            <input type="text" class="form-control" value="" name="floor" id="floor"
                              placeholder="Enter Number Of Floor" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="unit" class="">Unit Per Floor :</label>
                            <input type="text" class="form-control" value="" name="unit" id="unit"
                              placeholder="Enter Number Of Unit Per Floor" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="unit" class="">Flat Sequence :</label>
                        <select name="sequence" id="" class="form-control" required>
                          <option value="" selected disabled>Select Once</option>
                          <option value="1">A1,A2,A3</option>
                          <option value="2">A1,B1,C1</option>
                          <option value="3">1A,2A,3A</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="unit" class="">Amount of Service Charge :</label>
                        <input type="text" class="form-control" value="" name="amount"
                          placeholder="Enter Service Charge" required>
                      </div>
                      <div class="">
                        <button type="submit" class="btn btn-sm btn-primary" id="generate">Generate</button>
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
