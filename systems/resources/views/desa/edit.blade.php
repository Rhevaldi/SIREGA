@extends('layouts.app')
@section('title', 'Edit Desa')
@section('page-title', 'Edit Desa')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Desa</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('desa.update', $desa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_desa">Nama Desa</label>
                    <input type="text" name="nama_desa" id="nama_desa" class="form-control" value="{{ $desa->nama_desa }}" required>
                </div>
                <div class="form-group">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan" class="form-control" value="{{ $desa->kecamatan }}">
                </div>
                <div class="form-group">
                    <label for="kabupaten">Kabupaten</label>
                    <input type="text" name="kabupaten" id="kabupaten" class="form-control" value="{{ $desa->kabupaten }}">
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" name="provinsi" id="provinsi" class="form-control" value="{{ $desa->provinsi }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection