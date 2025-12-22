@extends('layouts.auth')

@section('title', 'Login SIREGA')

@section('content')
    <div class="login-box">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b>SIREGA</b></a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                                autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12 col-md-4">
                                <button type="submit" class="btn btn-primary w-100" aria-label="{{ __('Sign In') }}">
                                    {{ __('Sign In') }}
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
