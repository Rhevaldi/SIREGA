@extends('layouts.app')

@section('title', 'Tambah RT')
@section('page-title', 'Tambah RT')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Tambah RT</h3>
    </div>

    <form action="{{ route('rt.store') }}" method="POST">
        @csrf

        <div class="card-body">


            <div class="form-group">
                <label>Desa</label>
                <select name="desa_id"
                        class="form-control @error('desa_id') is-invalid @enderror"
                        required>
                    <option value="">-- Pilih Desa --</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}"
                            {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                            {{ $desa->nama_desa }}
                        </option>
                    @endforeach
                </select>
                @error('desa_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                <label>Nama RT</label>
                <input type="text"
                       name="nama_rt"
                       class="form-control @error('nama_rt') is-invalid @enderror"
                       value="{{ old('nama_rt') }}"
                       placeholder="Contoh: RT 01"
                       required>
                @error('nama_rt')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group">
                <label>Ketua RT</label>
                <select name="ketua_warga_id"
                        class="form-control @error('ketua_warga_id') is-invalid @enderror"
                        required>
                    <option value="">-- Pilih Ketua RT --</option>
                    @foreach($wargas as $warga)
                        <option value="{{ $warga->id }}"
                            {{ old('ketua_warga_id') == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nama }}
                        </option>
                    @endforeach
                </select>
                @error('ketua_warga_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>


        </div>

        <div class="card-footer">
            <a href="{{ route('rt.index') }}" class="btn btn-secondary">
                Kembali
            </a>
            <button type="submit" class="btn btn-primary float-right">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
