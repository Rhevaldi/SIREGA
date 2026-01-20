@extends('layouts.app')

@section('title', 'Tambah Program Bansos')
@section('page-title', 'Tambah Program Bansos')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('bansos.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Nama Program</label>
                <input type="text" name="nama_program" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Jenis Bantuan</label>
                <select name="jenis" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="uang">Uang</option>
                    <option value="barang">Barang</option>
                    <option value="jasa">Jasa</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Penyelenggara</label>
                <input type="text" name="penyelenggara" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control" required>
            </div>

            <div class="text-right">
                <a href="{{ route('bansos.index') }}" class="btn btn-secondary">Kembali</a>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
