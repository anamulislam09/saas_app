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
                    <form action="{{ route('income.collection.all') }}" method="post">
                      @csrf
                      <div class="row my-4">
                        <div class="col-lg-3">
                          <strong><span>Create voucher </span></strong>
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
                        {{-- 'month', date('m'))->where('year', date('Y') --}}
                        <div class="col-lg-3">
                          {{-- <label for="" class="col-form-label">Select Month</label> --}}
                          <select name="month" class="form-control" id="" required>
                            <option value="" selected disabled>Select Month </option>
                            <option value="1">January
                            </option>
                            <option value="2">February
                            </option>
                            <option value="3">March
                            </option>
                            <option value="4">April
                            </option>
                            <option value="5">May</option>
                            <option value="6">June
                            </option>
                            <option value="7">July
                            </option>
                            <option value="8">August
                            </option>
                            <option value="9">September
                            </option>
                            <option value="10">October
                            </option>
                            <option value="11">November
                            </option>
                            <option value="12">December
                            </option>
                          </select>
                        </div>

                        {{-- @if (Route::current()->getName() == 'income.create') --}}
                        <div class="col-lg-2">
                          <label for="" class="col-form-label"></label>
                          <input type="submit" class="btn btn-primary" value="Generate">
                        </div>
                        {{-- @else --}}
                        {{-- @endif --}}
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if (isset($data) && !empty($data))
                  {{-- @php   
                    @foreach ($data as $key => $item)
                    $month = Ap\Models\Income::where('month', $item->month)->where('year', $item->year)->where('customer_id', Auth::guard('admin')->user()->id)->first();
                    @endforeach
             @endphp --}}
                  <div class="card">
                    <div class="card-header">
                      <div class="row">
                        <div class="col-9">
                          <strong> Total collection month of @if ($months->month == 1)
                              January
                            @elseif ($months->month == 2)
                              February
                            @elseif ($months->month == 3)
                              March
                            @elseif ($months->month == 4)
                              April
                            @elseif ($months->month == 5)
                              May
                            @elseif ($months->month == 6)
                              June
                            @elseif ($months->month == 7)
                              July
                            @elseif ($months->month == 8)
                              August
                            @elseif ($months->month == 9)
                              September
                            @elseif ($months->month == 10)
                              October
                            @elseif ($months->month == 11)
                              November
                            @elseif ($months->month == 12)
                              December
                            @endif </strong>
                        </div>
                        <div class="col-3">

                          <a href="#" class="btn btn-info text-end">Generate all</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <table id="dataTable" class="table table-bordered table-striped mt-3">
                    <thead>
                      <tr>
                        <th style="width: 8%">SL</th>
                        <th style="width: 15%">Flat Name</th>
                        <th style="width: 15%" class="text-right">Amount</th>
                        <th style="width: 15%" class="text-center">Status</th>
                        <th style="width: 15%" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($data as $key => $item)
                        <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>{{ $item->user_name }}</td>
                          <td class="text-right">
                            @if ($item->paid > 0)
                              {{ $item->paid }}
                            @else
                              00
                            @endif
                          </td>
                          <td class="text-center">
                            @if ($item->status == 1)
                              <span class="badge badge-primary">Paid</span>
                            @else
                              <span class="badge badge-danger">UnPaid</span>
                            @endif
                          </td>
                          <td class="text-center"><a href="#" class="btn btn-sm btn-info">Voucher</a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                @else
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
@endsection
