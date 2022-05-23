@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header mx-5">
    <div class="container-fluid ">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Employee</li>
                </ol>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-12">
                <!-- warna custom -->
                <!-- <div class="col-md-4">
                    <a href="produk/create" class="btn btn-success btn-lg" style="background-color: #444444; border: hidden">Tambah Data</a>
                </div> -->
                @if ($message = Session::get('create'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle text-white"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('change'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle text-white"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('delete'))
                <div class="alert bg-gradient-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-header">
            <div class="card-tools my-3">
                <button type="button" class="btn btn-tool">
                    <a href="user/create" class="btn btn-block bg-green text-white btn-md"><i class="fas fa-plus"></i> Create User</a>
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- data table dimasukan class table-responsive jika mau dibawahnya bs discroll dan responsive di jquery di falsekan -->
            <!-- display nowrap tampilan table compact dan rapih -->
            <table id="example1" class="table display nowrap table-hover  table-striped table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Is Admin</th>
                        <th>Sex</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ucwords($data->fullname)}}</td>
                        <td>{{ucwords($data->username)}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            @if($data->is_admin === 1)
                            <span class="badge badge-success">Admin</span>
                            @else
                            <span class="badge badge-primary">Non Admin</span>
                            @endif
                        </td>
                        <td>{{ucwords($data->sex)}}</td>
                        <td>{{ucwords($data->address)}}</td>
                        <td>{{$data->phone_number}}</td>
                        <td>
                            <!-- <a href="/user/{{$data->id}}" class="badge badge-info"><i class="far fa-eye"></i></a> -->
                            <a href="/user/{{$data->id}}/edit" class="badge badge-success"><i class="far fa-edit"></i></a>
                            <!-- <a href="" class="badge badge-danger">delete</a> -->
                            <form action="/user/{{$data->id}}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="badge badge-danger border-0" onclick="return confirm('Are you sure you want to delete ?')"><i class="far fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
@endsection