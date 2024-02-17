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
                                        <h3 class="card-title">Opening Entry Form</h3>
                                    </div>
                                    {{-- <div class="col-lg-2 col-sm-12">
                                        <a href="{{ route('flat.index') }}" class="btn btn-sm btn-outline-primary">All
                                            Flats</a>
                                    </div> --}}

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="row py-4">
                                    <div class="col-8 m-auto border p-5" style="background: #ddd">
                                        <form action="{{ route('opening.balance.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 form-group">
                                                    <label for="" class="col-form-label">Select Year</label>
                                                    <select name="year" class="form-control" id="" required>
                                                        <option value="" selected disabled>Select Year</option>
                                                        <option value="2023">Year 2023</option>
                                                        <option value="2024">Year 2024</option>
                                                        <option value="2025">Year 2025</option>
                                                        <option value="2026">Year 2026</option>
                                                        <option value="2027">Year 2027</option>
                                                        <option value="2028">Year 2028</option>
                                                        <option value="2029">Year 2029</option>
                                                        <option value="2030">Year 2030</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 form-group">
                                                    <label for="" class="col-form-label">Select Month</label>
                                                    <select name="month" class="form-control" id="" required>
                                                        <option value="" selected disabled>Select Month </option>
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
                                            </div>
                                            <div class="form-group">
                                                <label for="unit" class="">Amount of opening income :</label>
                                                <input type="text" class="form-control" value="" name="income"
                                                    placeholder="Enter Amount" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="unit" class="">Amount of opening expense :</label>
                                                <input type="text" class="form-control" value="" name="expense"
                                                    placeholder="Enter amount" required>
                                            </div>
                                            <div class="">
                                                <button type="submit" class="btn btn-sm btn-primary"
                                                    id="generate">Submit</button>
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
