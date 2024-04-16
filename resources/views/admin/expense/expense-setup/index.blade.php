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
                                <h3 class="card-title pt-2" style="width:100%; text-align:center">Expense Setup</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- /.card-header -->
                                <div class="row">
                                    <div class="col-lg-12 border p-4" style="background: #f0eeee">
                                        <form action="{{ route('expense.setup.create') }}" method="POST" id="form">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-5">
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
                                                <div class="col-lg-5">
                                                    <div class="form-group">
                                                        <label for="unit" class="">Interval Days :</label>
                                                        <input type="text" class="form-control" value=""
                                                            name="days" id="days" placeholder="Enter Interval Days"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <button type="submit" id="submitBtn" class="btn btn-sm btn-primary" style="margin-top: 35px">Submit</button>
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
                                        <strong class="d-flex justify-content-center mb-2"><span id="user"></span>&nbsp; Expense Setup</strong>
                                        <hr>
                                        <div class="card-body table-responsive">
                                            <table id="dataTable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr style="border-top: 1px solid #ddd">
                                                        <th width="10%">SL</th>
                                                        <th width="15%">Exp Name</th>
                                                        <th width="20%">Interval Days</th>
                                                        <th width="20%">Start Date</th>
                                                        <th width="15%">End Date</th>
                                                        <th width="15%">Status </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="item-table">
                                                    @foreach ($data as $key => $item)
                                                    @php
                                                        $category = App\Models\Category::where('id', $item->exp_id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $category->name}}</td>
                                                        <td>{{ $item->interval_days}}</td>
                                                        <td>{{ $item->start_date}}</td>
                                                        <td>{{ $item->end_date}}</td>
                                                        <td>
                                                            <span class="badge badge-primary">Done</span>
                                                            {{-- @if ($expense->start_date - )
                                                                <span class="badge badge-primary"></span>
                                                                @elseif ($expense->status == 1)
                                                                <span class="badge badge-primary"></span>
                                                                
                                                            @endif --}}
                                                        
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
        // var searchRequest = null;
        // $(function() {
        //     var minlength = 4;
        //     $("#customer_id").change(function() {
        //         customerLeader($(this).val());
        //     });
        // });

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
                    customerLeader();
                    $("#form")[0].reset(true);
                    $("#item-table")[0].reset(true);
                    // location. reload(true)
                }
            });
        });

        // function customerLeader() {
        //     $.ajax({
        //         type: "GET",
        //         url: "{{ url('admin/expense-setup') }}/",
        //         dataType: "json",
        //         success: function(res) {
        //             // $('#user').text(res.users.name + '`s');
        //             // $('#user_id').val(res.users.user_id);
        //             // $('#users_id').val(res.users.user_id);
        //             // $('#amount').text(res.total_amount);
        //             // $('#total_collection').text(res.total_collection);
        //             // $('#total_due').text(res.total_due);

        //             var tbody = '';
        //             res.ledger.forEach((element, index) => {
        //                 // url = '{{ url('admin/generate-invoice') }}/' + element.invoice_id;

        //                 tbody += '<tr>'
        //                 tbody += '<td>' + (index + 1) + '</td>'
        //                 tbody += '<td>' + element.interval_days + '</td>'
        //                 tbody += '<td>' + element.start_date + '</td>'
        //                 tbody += '<td>' + element.end_date + '</td>'
        //                 // tbody += '<td class="text-center"><a href="' + url + '" target ="_blank"><span class="fa fa-book"></span></a></td>'
        //                 tbody += '</tr>'
        //             });
        //             $('#item-table').html(tbody);
        //         }
        //     });
        // }
    </script>

@endsection
