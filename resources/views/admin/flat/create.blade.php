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
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-8 col-sm-8 ">
                    {{-- {{$data}} --}}
                    @if (isset($flat) && !empty($flat))
                    <p class="mt-3 py-2 text-white text-center" style="background: #11d331;width:500px;border-radius:20px">Welcome, You have already created flat.</p>
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
                        <li>Created date:  <span style="font-size: 16px"> ({{ date($data->create_date)}} {{$data->create_month}} {{$data->create_year}})</span></li>
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
                            <label for="floor" class="">No of floor :</label>
                            <input type="text" class="form-control" value="" name="floor" id="floor"
                              placeholder="Enter Number Of Floor" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="unit" class="">Unit per floor :</label>
                            <input type="text" class="form-control" value="" name="unit" id="unit"
                              placeholder="Enter Number Of Unit Per Floor" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="unit" class="">Flat sequence :</label>
                        <select name="sequence" id="" class="form-control" required>
                          <option value="" selected disabled>Select Once</option>
                          <option value="1">A1,A2,A3</option>
                          <option value="2">A1,B1,C1</option>
                          <option value="3">1A,2A,3A</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="unit" class="">Amount of service charge :</label>
                        <input type="text" class="form-control" value="" name="amount"
                          placeholder="Enter Service charge" required>
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


  {{-- <script>
         $('#generate').click(function(){
                let flat = '';
                let id = 0;
                $('#floor').each(function(){
                    // let coloName = $(this).text();
                    let floor = $(this).val();
            alert(floor);
                    $('#unit').each(function(){
                        // let sizeName = $(this).text();
                        let unit = $(this).val();
                        flat += '<tr>';
                        flat += '<td align="center" valign="middle" class="serial"></td>';
                        flat += '<td align="left" valign="middle">' + floor + '</td>';
                        flat += '<td align="left" valign="middle">' + unit + '</td>';
                        // flat += '<td><input type="number" name="stock[]" class="form-control form-control-sm" style="text-align:right" min="0" placeholder="0.00" required></td>';

                        // flat += '<td align="left" valign="middle"><label class="col-3">';
                        // flat +=     '<img id="image-'+id+'" style="width:100px!imporatant; height:100px!imporatant;" class="img-thumbnail" src="{{ asset("public/uploads/admin/placeholder.png") }}">'
                        // flat +=      '<input hidden onchange="variantImage('+id+');" class="form-control form-control-sm variantImage" type="file" name="image[]">';
                        // flat += '</label></td>';
                        
                        // flat += '<input type="hidden" name="color_id[]" value="' + coloID + '">';
                        // flat += '<input type="hidden" name="size_id[]" value="' + sizeID + '">';
                        // flat += '<td align="center" valign="middle">';
                        // flat += '<button class="btn btn-danger btn-sm item-delete"><i class="fa fa-trash" style="cursor:pointer"></i></button></td>';
                        flat += '</tr>';

                        id++;
                    });
                });
                $('.item-table').html(flat);
                serialMaintain();
            });
    </script> --}}
@endsection
