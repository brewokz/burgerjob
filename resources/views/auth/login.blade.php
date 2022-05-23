@extends('layouts.defaultLogin')
@section('content')
<div class="login-box col-md-4 mt-4">
    @if ($message = Session::get('loginError'))
    <div class="alert bg-gradient-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="login-logo">
        <a href="/"><b>Burger</b>Job</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your sessions</p>

            <form action="/login" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" id="username" autofocus required>
                    @error('username')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    <div class="input-group-append" name="password" id="password">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <!-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> -->
            <!-- <p class="mb-0">
                <a href="/register/create" class="text-center">Register a new membership</a>
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
@endsection