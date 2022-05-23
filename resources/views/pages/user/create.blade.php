@extends('layouts.default')

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

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content mx-5">

    <!-- Default box -->
    <div class="card p-3 shadow shadow-lg">
        <div class="card-header">
            <h3 class="card-title text-bold">Form Create User</h3>
        </div>
        <div class="card-body mx-4">
            <form method="post" enctype="multipart/form-data" action="/user">
                @csrf
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label text-right">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullname" name="fullname" value="{{old('fullname')}}">
                        @error('fullname')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label  text-right">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{old('username')}}">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label  text-right">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="is_admin" class="col-sm-2 col-form-label  text-right">Role</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('is_admin') is-invalid @enderror" id="is_admin" name="is_admin">
                            <option value="0" @if(old('is_admin')=='0' ) selected @endif>User</option>
                            <option value="1" @if(old('is_admin')=='1' ) selected @endif>Admin User</option>
                        </select>
                        @error('is_admin')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sex" class="col-sm-2 col-form-label  text-right">Sex</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 @error('sex') is-invalid @enderror" id="sex" name="sex">
                            <option value="male" @if(old('sex')=='male' ) selected @endif>Male</option>
                            <option value="female" @if(old('sex')=='female' ) selected @endif>Female</option>
                        </select>
                        @error('sex')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number" class="col-sm-2 col-form-label  text-right">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{old('phone_number')}}">
                        @error('phone_number')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label  text-right">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}">
                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <!-- Confirm Password -->
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label text-right" :value="__(Confirm Password)">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row float-sm-right">
                    <div class="col">
                        <button class="btn btn-block bg-red text-white"><a href="/user">Cancel</a></button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-block bg-green text-white">Create</button>
                    </div>
                </div>
            </form>
            </script>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection