@extends('layouts.default')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
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
            <h3 class="card-title">Form Change Password</h3>

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
            <form method="post" enctype="multipart/form-data" action="/password/{{$user->id}}">
                @method('PATCH')
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <!-- Konfirmasi Password -->
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label" :value="__(Confirm Password)">Konfirmasi Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row float-sm-right p-2">
                    <div class="col">
                        <button type="submit" class="btn btn-block bg-gradient-success btn-lg">Update Password</button>
                    </div>
                </div>
                <div class="form-group row float-sm-right d-inline p-2 col-sm-2">
                    <div class="col">
                        <a href="/user/{{$user->id}}/edit" class="btn btn-block bg-gradient-primary btn-lg">Back</a>
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