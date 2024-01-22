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
                                    <div class="col-lg-9 col-sm-12">
                                        <h3 class="card-title">All Permissions</h3>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <a href="{{ route('permission.create') }}" class="btn btn-outline-primary">Add
                                            Permission</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
