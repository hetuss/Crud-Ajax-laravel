@extends('admin.layouts.app')

@section('body')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="card px-2 pt-2">
                        <h1>{{ $title }} Details</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6 offset-md-3 ">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body  p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30%">Name</th>
                                        <td width="70%">{{ $record['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $record['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <td>{{ $record['contact'] }}</td>
                                    </tr>
                                     <tr>
                                        <th>Age</th>
                                        <td>{{ $record['age'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>{{ $record['gender'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>User Status</th>
                                        <td>{{ $record['relation_status'] }}</td>
                                    </tr>
                                     <tr>
                                        <th>Status</th>
                                        <td>{{ $record['status'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $record['created_at']->format(config('setting.DATETIME_FORMAT')) }}</td>
                                    </tr>

                                </thead>
                            </table>
                            <a href="{{ route($route . 'index') }}" type="submit" class="btn btn-dark m-3">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
