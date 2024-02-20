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
                                    <div class="col-lg-12" style="border: 1px solid #ddd">
                                        <form action="{{ route('incomesall.year') }}" method="post">
                                            @csrf
                                            <div class="row my-4">
                                                <div class="col-lg-3">
                                                    <strong><span>Yearly Income </span></strong>
                                                </div>
                                                <div class="col-lg-3">
                                                    {{-- <label for="" class="col-form-label">Select Year</label> --}}
                                                    <select name="year" class="form-control" id="" required>
                                                        <option value="" selected disabled>Select Year</option>
                                                        <option value="2023">Year 2023
                                                        </option>
                                                        <option value="2024">Year 2024
                                                        </option>
                                                        <option value="2025">Year 2025
                                                        </option>
                                                        <option value="2026">Year 2026
                                                        </option>
                                                        <option value="2027">Year 2027
                                                        </option>
                                                        <option value="2028">Year 2028
                                                        </option>
                                                        <option value="2029">Year 2029
                                                        </option>
                                                        <option value="2030">Year 2030
                                                        </option>
                                                    </select>
                                                </div>
                                                {{-- @if (Route::current()->getName() == 'income.create') --}}
                                                <div class="col-lg-2">
                                                    <label for="" class="col-form-label"></label>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                                {{-- @else --}}
                                                {{-- @endif --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @php
                                $data = Session::get('yearly_income');
                                $year = Session::get('year');
                                $others_income = Session::get('others_income');
                            @endphp

                            @if (isset($data) && !empty($data))
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-10 col-sm-12">
                                            <h3 class="card-title">Total Income month of {{ $year->year }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="8%">Sl</th>
                                                <th>Income Head</th>
                                                <th width="20%">Total Income</th>
                                                {{-- <th class="text-center">Total expense</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Flag</th> --}}
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">0</td>
                                                <td class="text-left">{{ $year->charge }}</td>
                                                <td class="text-right">{{ $data }}</td>
                                            </tr>
                                            @foreach ($others_income as $key => $item)
                                            @php
                                                $others_total = App\Models\OthersIncome::where('year', $item->year)->where('customer_id', Auth::guard('admin')->user()->id)->sum('amount');
                                            @endphp
                                                <tr>
                                                    <td class="text-center">{{ $key + 1 }}</td>
                                                    <td class="text-left">{{ $item->income_info }}</td>
                                                    <td class="text-right">{{ $item->amount }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-right"><strong>Total : </strong></td>
                                                @if (isset($others_total))
                                                <td colspan="2" class="text-right"><strong>{{$data + $others_total}}</strong></td>
                                                @else
                                                <td colspan="2" class="text-right"><strong>{{$data }}</strong></td>
                                                @endif
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
