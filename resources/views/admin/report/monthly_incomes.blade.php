@extends('layouts.admin')

@section('admin_content')
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
                                        <h3 class="card-title">Yearly Income</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th class="d-none">Year</th>
                                            <th>Month</th>
                                            <th class="text-center">Flat Name</th>
                                            <th class="text-center">Collect</th>
                                            {{-- <th class="text-center">Collection</th> --}}
                                            <th class="text-center">Due</th>
                                            <th class="text-center">Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthly_income as $key => $item)
                                            @php
                                                $user = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->exists();
                                                $userName = DB::table('users')
                                                    ->where('user_id', $item->auth_id)
                                                    ->first();

                                                $customer = DB::table('customers')
                                                    ->where('id', $item->customer_id)
                                                    ->exists();
                                              
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="d-none"> {{$item->year}}</td>
                                                <td> 
                                                    @if ($item->month == 1)
                                                    January
                                                @elseif ($item->month == 2)
                                                    February
                                                @elseif ($item->month == 3)
                                                    March
                                                @elseif ($item->month == 4)
                                                    April
                                                @elseif ($item->month == 5)
                                                    May
                                                @elseif ($item->month == 6)
                                                    June
                                                @elseif ($item->month == 7)
                                                    July
                                                @elseif ($item->month == 8)
                                                    August
                                                @elseif ($item->month == 9)
                                                    September
                                                @elseif ($item->month == 10)
                                                    October
                                                @elseif ($item->month == 11)
                                                    November
                                                @elseif ($item->month == 12)
                                                    December
                                                @endif
                                                </td>
                                                <td>{{ $item->flat_name }}</td>
                                                <td class="text-right">
                                                    @if ( @empty($item->paid ))
                                                        00
                                                    @else
                                                    {{ $item->paid }}
                                                    @endif
                                                </td>
                                                @if ($user)
                                                <td class="text-center">{{ $userName->name }}</td>
                                                @elseif ($customer)
                                                {{-- <td>{{ $customerName->name }}</td> --}}
                                                <td class="text-right">{{ $item->due }}</td>
                                                <td class="text-center"><span class="badge badge-success">Admin</span>
                                                    </td>
                                                @endif
                                            </tr>
                                          
                                            @endforeach
                                    </tbody>
                                    {{-- <tfoot> --}}
                                        {{-- <tr>
                                            <td colspan="3"><strong>Total = </strong></td>
                                            <td>{{$total}}</td>
                                        </tr> --}}
                                    {{-- </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
