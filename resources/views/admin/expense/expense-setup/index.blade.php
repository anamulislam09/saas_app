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
                                <h3 class="card-title pt-2" style="width:100%; text-align:center">Expense Schedule Setup</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="row">
                                    <div class="col-lg-12 border p-4" style="background: #f0eeee">
                                        <form action="{{ route('expense.setup.create') }}" method="POST" id="form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class=" form-group">
                                                        <label for="floor" class="">Select Expense</label>
                                                        <select name="exp_id" id="exp_id" class="form-control">
                                                            <option value="" selected disabled>Select Once</option>
                                                            @foreach ($expenses as $expense)
                                                                <option value="{{ $expense->id }}">{{ $expense->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class=" form-group">
                                                        <label for="floor" class="">Select Vendor</label>
                                                        <select name="vendor_id" id="vendor_id" class="form-control">
                                                            <option value="" selected disabled>Select Once</option>
                                                            @foreach ($vendor as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label for="unit" class="">Interval Days :</label>
                                                        <input type="text" class="form-control" value=""
                                                            name="days" id="days" placeholder="Enter Interval Days"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <button type="submit" id="submitBtn" class="btn btn-sm btn-primary"
                                                            style="margin-top: 35px">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <strong class="d-flex justify-content-center mb-2"><span
                                                id="user"></span>&nbsp; Expense Setup</strong>
                                        <hr>
                                        <div class="card-body table-responsive">
                                            <table id="dataTable" class="table table-bordered table-striped item-table">
                                                <thead>
                                                    <tr style="border-top: 1px solid #ddd">
                                                        <th width="10%">SL</th>
                                                        <th width="15%">Exp Name</th>
                                                        <th width="15%">Vendor</th>
                                                        <th width="15%">Interval Days</th>
                                                        <th width="15%">Start Date</th>
                                                        <th width="15%">End Date</th>
                                                        <th width="15%">Status </th>
                                                        <th width="15%">Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $item)
                                                        @php
                                                            $category = App\Models\Category::where(
                                                                'id',
                                                                $item->exp_id,
                                                            )->first();
                                                            $Vendor = App\Models\Addressbook::where(
                                                                'customer_id',
                                                                $item->customer_id,
                                                            )
                                                                ->where('id', $item->vendor_id)
                                                                ->first();
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $category->name }}</td>
                                                            <td>{{ $Vendor->name }}</td>
                                                            <td>{{ $item->interval_days }}</td>
                                                            <td>{{ date_format(date_create($item->start_date), 'Y/m/d ') }} </td>
                                                            <td>{{ date_format(date_create($item->end_date), 'Y/m/d ') }}</td>


                                                            <td>
                                                                @php
                                                                    $today = Carbon\Carbon::today()->toDateString();
                                                                    $datetime1 = new DateTime($item->start_date);
                                                                    $datetime2 = new DateTime($today);
                                                                    $difference = $datetime1->diff($datetime2);
                                                                @endphp
                                                                @if ($difference->days < 31)
                                                                    <span class="badge badge-primary">Good</span>
                                                                @elseif ($difference->days > 31 && $difference->days < $item->interval_days)
                                                                    <span class="badge badge-warning">Expired Soon</span>
                                                                @else
                                                                    <span class="badge badge-danger">Already Expired</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('expense.setup.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-primary"><i
                                                                        class="fas fa-edit"></i></a>
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
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#form").submit(function(e) {
            e.preventDefault();
            let exp_id = $("#exp_id").val();
            let days = $("#days").val();
            // alert(days);
            var form = $(this);
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'JSON',
                success: function(data) {
                    $("#form")[0].reset();
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
