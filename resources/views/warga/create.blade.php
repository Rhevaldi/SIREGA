@extends('layouts.app')

@section('title', 'Tambah Warga')
@section('page-title', 'Tambah Warga')

@section('content')

    <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
            <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                        class="form-control @error('nik') is-invalid @enderror">
                    @error('nik')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="form-control @error('nama') is-invalid @enderror">
                    @error('nama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin"
                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                        class="form-control @error('tempat_lahir') is-invalid @enderror">
                    @error('tempat_lahir')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror">
                    @error('tanggal_lahir')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="agama">Agama</label>
                    <input type="text" name="agama" id="agama" value="{{ old('agama') }}"
                        class="form-control @error('agama') is-invalid @enderror">
                    @error('agama')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="pendidikan">Pendidikan</label>
                    <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}"
                        class="form-control @error('pendidikan') is-invalid @enderror">
                    @error('pendidikan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="pekerjaan">Pekerjaan</label>
                    <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                        class="form-control @error('pekerjaan') is-invalid @enderror">
                    @error('pekerjaan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status_perkawinan">Status Perkawinan</label>
                    <input type="text" name="status_perkawinan" id="status_perkawinan"
                        value="{{ old('status_perkawinan') }}"
                        class="form-control @error('status_perkawinan') is-invalid @enderror">
                    @error('status_perkawinan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status_warga">Status Warga</label>
                    <select name="status_warga" id="status_warga"
                        class="form-control @error('status_warga') is-invalid @enderror">
                        <option value="">-- Pilih --</option>
                        <option value="aktif" {{ old('status_warga') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="pindah" {{ old('status_warga') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                        <option value="meninggal" {{ old('status_warga') == 'meninggal' ? 'selected' : '' }}>Meninggal
                        </option>
                    </select>
                    @error('status_warga')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="rt_id">RT</label>
                    <select name="rt_id" id="rt_id" class="form-control @error('rt_id') is-invalid @enderror">
                        <option value="">-- Pilih RT --</option>
                        @foreach ($rts as $rt)
                            <option value="{{ $rt->id }}" {{ old('rt_id') == $rt->id ? 'selected' : '' }}>
                                {{ $rt->nama_rt }}
                            </option>
                        @endforeach
                    </select>
                    @error('rt_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                        class="form-control @error('latitude') is-invalid @enderror">
                    @error('latitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                        class="form-control @error('longitude') is-invalid @enderror">
                    @error('longitude')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
    </div>

@endsection
