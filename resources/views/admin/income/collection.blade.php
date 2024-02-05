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
                                            <div class="row my-4">
                                                <div class="col-lg-3">
                                                    <strong><span>Service charge</span></strong>
                                                </div>
                                                <div class="col-lg-3">
                                                    {{-- <label for="" class="col-form-label">Select Year</label> --}}
                                                    <select name="year" class="form-control" id="">
                                                        <option value="" selected disabled>Select Year</option>
                                                        <option value="2023"
                                                            @if ('2023' == date('Y')) selected @endif>Year 2023
                                                        </option>
                                                        <option value="2024"
                                                            @if ('2024' == date('Y')) selected @endif>Year 2024
                                                        </option>
                                                        <option value="2025"
                                                            @if ('2025' == date('Y')) selected @endif>Year 2025
                                                        </option>
                                                        <option value="2026"
                                                            @if ('2026' == date('Y')) selected @endif>Year 2026
                                                        </option>
                                                        <option value="2027"
                                                            @if ('2027' == date('Y')) selected @endif>Year 2027
                                                        </option>
                                                        <option value="2028"
                                                            @if ('2028' == date('Y')) selected @endif>Year 2028
                                                        </option>
                                                        <option value="2029"
                                                            @if ('2029' == date('Y')) selected @endif>Year 2029
                                                        </option>
                                                        <option value="2030"
                                                            @if ('2030' == date('Y')) selected @endif>Year 2030
                                                        </option>
                                                    </select>
                                                </div>
                                                {{-- 'month', date('m'))->where('year', date('Y') --}}
                                                <div class="col-lg-3">
                                                    {{-- <label for="" class="col-form-label">Select Month</label> --}}
                                                    <select name="month" class="form-control" id="">
                                                        <option value="" selected disabled>Select Month </option>
                                                        <option value="01"
                                                            @if ('01' == date('m')) selected @endif>January
                                                        </option>
                                                        <option value="02"
                                                            @if ('02' == date('m')) selected @endif>February
                                                        </option>
                                                        <option value="03"
                                                            @if ('03' == date('m')) selected @endif>March
                                                        </option>
                                                        <option value="04"
                                                            @if ('04' == date('m')) selected @endif>April
                                                        </option>
                                                        <option value="05"
                                                            @if ('05' == date('m')) selected @endif>May</option>
                                                        <option value="06"
                                                            @if ('06' == date('m')) selected @endif>June
                                                        </option>
                                                        <option value="07"
                                                            @if ('07' == date('m')) selected @endif>July
                                                        </option>
                                                        <option value="08"
                                                            @if ('08' == date('m')) selected @endif>August
                                                        </option>
                                                        <option value="09"
                                                            @if ('09' == date('m')) selected @endif>September
                                                        </option>
                                                        <option value="10"
                                                            @if ('10' == date('m')) selected @endif>October
                                                        </option>
                                                        <option value="11"
                                                            @if ('11' == date('m')) selected @endif>November
                                                        </option>
                                                        <option value="12"
                                                            @if ('12' == date('m')) selected @endif>December
                                                        </option>
                                                    </select>
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
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Charge</th>
                                            <th>Amount</th>
                                            <th>Due</th>
                                            <th style="width: 15%">Collect</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (isset($data) && !empty($data))
                                            @foreach ($data as $item)
                                                <form action="{{ route('income.collection.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                                    <tr>
                                                        <td>{{ $item->user_id }}</td>
                                                        <td>{{ $item->user_name }}</td>
                                                        <td>{{ $item->charge }}</td>
                                                        <td>{{ $item->amount }}</td>
                                                        <td>{{ $item->due }}</td>
                                                        <td><input type="text"
                                                                style="width:100%; border:none; border-radius:20px; text-align:center"
                                                                name="pay" placeholder="000" required></td>
                                                        <td>
                                                            @if ($item->status == 1)
                                                                <span class="badge badge-success">Paid</span>
                                                            @else
                                                                <input type="submit" class="btn btn-sm btn-primary"
                                                                    value="Submit">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </form>
                                            @endforeach
                                        @else
                                        @endif
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
