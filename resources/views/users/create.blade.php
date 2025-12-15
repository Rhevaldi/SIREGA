@extends('layouts.app')

@section('title', 'SIREGA | Data Pengguna')
@section('page-title', 'Data Pengguna')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-1">Form Pengguna Baru</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Daftar Pengguna
                    </a>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input value="{{ old('name') }}" type="text" id="name" name="name"
                                class="form-control" placeholder="Masukkan Nama Lengkap" autofocus>
                            @error('name')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input value="{{ old('email') }}" type="email" id="email" name="email"
                                class="form-control" placeholder="Masukkan Email">
                            @error('email')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Level Akses <code>*</code></label>
                            <select id="role" name="role" class="form-control text-capitalize">
                                <option selected value="">- Pilih Level Akses -</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role') === $role->name ? 'selected' : false }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password <code>*</code></label>
                            <input value="{{ old('password') }}" type="password" id="password" name="password"
                                class="form-control" placeholder="Masukkan Password">
                            @error('password')
                                <p class="text-sm text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password <code>*</code></label>
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
