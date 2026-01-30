@extends('layouts.app')

@section('title', 'Edit Program Bansos')
@section('page-title', 'Edit Program Bansos')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('bansos.update', $bansos->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama Program</label>
                <input type="text" name="nama_program" class="form-control"
                       value="{{ $bansos->nama_program }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Jenis Bantuan</label>
                <select name="jenis" class="form-control" required>
                    <option value="uang" {{ $bansos->jenis == 'uang' ? 'selected' : '' }}>Uang</option>
                    <option value="barang" {{ $bansos->jenis == 'barang' ? 'selected' : '' }}>Barang</option>
                    <option value="jasa" {{ $bansos->jenis == 'jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Penyelenggara</label>
                <input type="text" name="penyelenggara" class="form-control"
                       value="{{ $bansos->penyelenggara }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control"
                       value="{{ $bansos->tahun }}" required>
            </div>

            <div class="text-right">
                <a href="{{ route('bansos.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
