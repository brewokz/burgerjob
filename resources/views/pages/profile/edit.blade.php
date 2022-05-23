@extends('layouts.withoutSidebar')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- warna custom -->
                <!-- <div class="col-md-4">
                    <a href="produk/create" class="btn btn-success btn-lg" style="background-color: #444444; border: hidden">Tambah Data</a>
                </div> -->
                <div class="col-md-4">
                    <!-- <a href="/user" class="btn btn-block bg-gradient-primary btn-lg">Back</a> -->
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Form Tambah User</li>
                </ol>
            </div> -->
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit user form</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="/profile/{{$user->id}}">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">Name*</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{$user->fullname}}">
                        @error('fullname')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">User Name*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{$user->username}}">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{$user->email}}">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sex" class="col-sm-2 col-form-label">Sex*</label>
                    <div class="col-sm-5">
                        <select class="form-control select2 @error('sex') is-invalid @enderror" id="sex" name="sex" value="{{$user->sex}}">
                            @if($user->sex==="male")
                            <option selected value="male">Male</option>
                            <option value="female">Female</option>
                            @else
                            <option value="male">Male</option>
                            <option selected value="female">Female</option>
                            @endif
                        </select>
                        @error('sex')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{$user->address}}">
                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number" class="col-sm-2 col-form-label">Phone Number*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{$user->phone_number}}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row float-sm-right p-2 col-sm-2">
                    <div class="col">
                        <button type="submit" class="btn btn-block bg-gradient-orange text-white btn-lg">Update User</button>
                    </div>
                </div>
                <div class="form-group row float-sm-right d-inline p-2 col-sm-2">
                    <div class="col">
                        <a href="/user/{{$user->id}}" class="btn btn-block bg-gradient-info btn-lg">Back</a>
                    </div>
                </div>
            </form>
            </script>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection