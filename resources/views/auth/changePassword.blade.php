@extends('layouts.defaultLogin')
@section('content')
<div class="login-box col-md-4 mt-4">
    @if ($message = Session::get('loginError'))
    <div class="alert bg-gradient-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
        <strong>{{ $message }}</strong>
    </div>
    @elseif ($message = Session::get('error'))
    <div class="alert bg-gradient-danger alert-block">
        <button type="button" class="close" data-dismiss="alert"><i class="far fa-times-circle"></i></button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="login-logo">
        <a href="/"><b>Burger</b>Job</a>
    </div>
    <!-- /.login-logo -->
    <div class="card mb-5">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Change your password</p>

            <form action="/user/{{Auth::User()->id}}/update-password" method="post">
                @method('PATCH')
                @csrf
                <div class="input-group mb-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <label for="password_confirmation" :value="__(Confirm Password)"></label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    <div class="input-group-append" name="password" id="password">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-6">
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
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