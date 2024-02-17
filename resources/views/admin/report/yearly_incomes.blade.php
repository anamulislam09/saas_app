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
                                            <th>Year</th>
                                            <th>SL</th>
                                            <th class="text-center">Flat Name</th>
                                            <th class="text-center">Collect</th>
                                            <th class="text-center">Due</th>
                                            <th class="text-center">Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($yearly_income as $key => $item)
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
                                                // $customerName = DB::table('customers')->where('id', $item->customer_id)->first();

                                                $data = DB::table('categories')
                                                    ->where('id', $item->cat_id)
                                                    ->first();

                                                // dd($customer);
                                                // Total amount
                                                // $total = App\Models\Exp_detail::where('customer_id', $item->customer_id)
                                                // ->where('month', $item->month)
                                                //      ->sum('amount');

                                            @endphp
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->year }}</td>
                                                <td>{{ $item->user_name }}</td>
                                                <td class="text-right">
                                                    @if ( @empty($item->paid ))
                                                        00
                                                    @else
                                                    {{ $item->paid }}
                                                    @endif
                                                </td>
                                                
                                                <td class="text-right">{{ $item->due }}</td>
                                                @if ($user)
                                                    <td class="text-center">{{ $userName->name }}</td>
                                                @elseif ($customer)
                                                    {{-- <td>{{ $customerName->name }}</td> --}}
                                                    <td class="text-center"><span class="badge badge-success">Admin</span>
                                                    </td>
                                                @endif
                                            </tr>
                                            {{-- @php
                                            // $total  = '';
                                                $total += $total+ $item->amount
                                            @endphp --}}
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
