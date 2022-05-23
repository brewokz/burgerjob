@extends('layouts.withoutSidebar')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if ($message = Session::get('change'))
                <div class="alert bg-gradient-primary alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @elseif ($message = Session::get('error'))
                <div class="alert bg-gradient-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <h1 class="m-0"> Good Morning <small>this is your profile</small></h1>
            </div><!-- /.col -->
            <!-- <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Top Navigation</li>
                </ol>
            </div> -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user shadow">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="bg-info">
                        <h3 class="widget-user-username col-sm-6 container">Photo Profile</h3>
                        <!-- <h5 class="widget-user-desc">Founder & CEO</h5> -->
                    </div>
                    <div class="container col-sm-7 mt-3 mb-3">
                        <a href="#" data-toggle="modal" data-target="#uploadImage">
                            <img class="rounded" src="{{ asset('profile-picture/'.Auth()->User()->profile_picture)}}" width="200" height="200" alt="User Avatar">
                        </a>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="row">
                            <div class="container col-sm-6">
                                <div class="">
                                    <a href="#" class="btn btn-block bg-gradient-navy btn-lg text-white" data-toggle="modal" data-target="#uploadImage">
                                        Change Image
                                    </a>
                                </div>
                                <!-- /.description-block -->
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>

            <!-- Upload Image -->
            <div class="modal fade" id="uploadImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="post" action="/profile-photo/{{Auth()->User()->id}}" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Upload Image</h5>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}

                                <label>Choose your photo</label>
                                <div class="form-group">
                                    <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{old('photo')}}" required="required">
                                    @error('photo')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-gradient-info" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn bg-gradient-orange">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- /.col-md-6 -->
            <div class="col-lg-7 container">
                <div class="card">

                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user shadow">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="accent-color text-dark">
                            <h3 class="widget-user-username container col-sm-2">Profile</h3>
                        </div>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        Name
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{ucwords($user->fullname)}}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        User Name
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{$user->username}}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        Email
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{$user->email}}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        Sex
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{ucwords($user->sex)}}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        Address
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{ucwords($user->address)}}
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <h5 class="ml-5">
                                        Phone Number
                                    </h5>
                                </div>
                                <div class="col-sm-8">
                                    <h5 class="ml-3">
                                        {{ucwords($user->phone_number)}}
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <a href="/" class="btn btn-block bg-gradient-info btn-lg">Back</a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <a href="/profile-password/{{Auth()->User()->id}}/edit" class="btn btn-block bg-gradient-red btn-lg">Change Password</a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <a href="/profile/{{Auth()->User()->id}}/edit" class="btn btn-block bg-gradient-warning btn-lg">Edit</a>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->

                </div>

                <!-- <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title m-0">Featured</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Special title treatment</h6>

                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div> -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
@endsection