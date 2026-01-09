@extends('layouts.app')

@section('title', 'Akun Saya')
@section('page-title', 'Akun Saya')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Akun Saya</h3>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input value="{{ $user->name }}" type="text" id="name" name="name"
                                class="form-control" placeholder="Masukkan Nama Lengkap" autofocus>
                            @error('name')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input value="{{ $user->email }}" type="email" id="email" name="email"
                                class="form-control" placeholder="Masukkan Email">
                            @error('email')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Level Akses <code>*</code></label>
                            <select id="role" name="role" class="form-control text-capitalize" disabled>
                                <option selected value="">{{ $user->roles()->first()->name }}</option>
                            </select>
                            @error('role')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="password">Password <code>*Abaikan jika tidak ingin merubah password</code></label>
                            <input value="{{ old('password') }}" type="password" id="password" name="password"
                                class="form-control" placeholder="Masukkan Password">
                            @error('password')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input value="{{ old('password_confirmation') }}" type="password" id="password_confirmation"
                                name="password_confirmation" class="form-control"
                                placeholder="Masukkan Konfirmasi Password">
                            @error('password_confirmation')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
