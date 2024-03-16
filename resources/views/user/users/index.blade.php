@extends('user.user_layouts.user')

@section('user_content')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }

        .modal-dialog {
            max-width: 650px;
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
                                <h3 class="card-title pt-2" style="width:100%; text-align:center">All Users</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User_Id</th>
                                        {{-- <th width="10%">Customer_Id</th> --}}
                                        <th>User Name</th>
                                        <th>Flat Name</th>
                                        <th>Phone/Passport</th>
                                        <th>Email</th>
                                        <th>NID/NRC</th>
                                        <th>Status</th>
                                        {{-- <th>Role_id</th> --}}
                                        <th> Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        @php
                                            $user = App\Models\User::where('user_id', Auth::user()->user_id)->first();
                                            $flat = DB::table('flats')
                                                ->where('customer_id', $user->customer_id)
                                                ->where('flat_unique_id', $item->flat_id)
                                                ->first();
                                        @endphp
                                        <tr>
                                            <td>{{ $item->user_id }}</td>
                                            <td>{{ $item->name }}</td>
                                            @if (!empty($flat))
                                                <td>{{ $flat->flat_name }}</td>
                                            @else
                                                <td>Undefine</td>
                                            @endif
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->nid_no }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge badge-danger">Deactive</span>
                                                @else
                                                    <span class="badge badge-primary">Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-info edit"
                                                    data-id="{{ $item->id }}" data-toggle="modal"
                                                    data-target="#editUser"><i class="fas fa-edit"></i></a>
                                                {{-- <a href="{{ route('user.delete', $item->id) }}"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a> --}}
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
    </section>
    </div>

    {{-- category edit model --}}
    <!-- Modal -->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="model-main">
               
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>
    <script>
        $('body').on('click', '.edit', function() {
            let user_id = $(this).data('id');
            $.get("/users/edit/" + user_id, function(data) {
                $('#model-main').html(data);

            })
        })
    </script>
@endsection
