@extends('layouts.app')

@section('title', 'Tambah Desa')
@section('page-title', 'Tambah Desa')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Desa</h3>
        </div>

        <form action="{{ route('desa.store') }}" method="POST">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label>Nama Desa</label>
                    <input type="text" name="nama_desa" class="form-control @error('nama_desa') is-invalid @enderror"
                        value="{{ old('nama_desa') }}" required>
                    @error('nama_desa')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}">
                </div>

                <div class="form-group">
                    <label>Kabupaten</label>
                    <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten') }}">
                </div>

                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi') }}">
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('desa.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-primary float-right">
                    Simpan
                </button>
            </div>

            
        </form>
    </div>
@endsection
