@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b>SIREGA TES AUTO DEPLoOY</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Masuk untuk memulai sesi anda</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                                autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-sm text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-sm text-danger">{{ $message }}</p>
                        @enderror

                        <div class="row justify-content-center mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Masuk
                                </button>
                            </div>
                        </div>


                    </form>





                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
