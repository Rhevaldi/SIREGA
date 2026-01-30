@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode</label>
                <input type="text" name="kode" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipe</label>
                <select name="tipe" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="sosial">Sosial</option>
                    <option value="ekonomi">Ekonomi</option>
                    <option value="hunian">Hunian</option>
                    <option value="kesehatan">Kesehatan</option>
                    <option value="administratif">Administratif</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
