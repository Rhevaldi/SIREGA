@extends('layouts.app')

@section('title', 'Tambah Warga')
@section('page-title', 'Tambah Warga')

@section('content')

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- INFORMASI DETAIL WARGA --}}
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Informasi Detail Warga</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        No. Kartu Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="no_kk" class="form-control select2bs4">
                                        <option value="" selected>-- Pilih Kartu Keluarga --</option>
                                        @foreach ($kartu_keluargas as $data)
                                            <option value="{{ $data->no_kk }}"
                                                {{ old('no_kk') == $data->no_kk ? 'selected' : '' }}>
                                                {{ $data->no_kk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('no_kk')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        NIK <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                                    @error('nik')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>
                                        Nama Lengkap <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Tempat Lahir <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Tanggal Lahir <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Jenis Kelamin <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="jenis_kelamin" class="form-control select2">
                                        <option value="">-- Pilih Jenis Kelamin--</option>
                                        @foreach ($jenis_kelamin as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('jenis_kelamin') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Agama <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="agama" class="form-control select2">
                                        <option value="">-- Pilih Agama --</option>
                                        @foreach ($religions as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('agama') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('agama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Pendidikan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="pendidikan" class="form-control select2">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        @foreach ($pendidikan as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('pendidikan') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pendidikan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Pekerjaan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="pekerjaan_id" class="form-control select2bs4">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        @foreach ($pekerjaans as $pekerjaan)
                                            <option value="{{ $pekerjaan->id }}"
                                                {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                                                {{ $pekerjaan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pekerjaan_id')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>
                                        Status Hubungan Dalam Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_hubungan" class="form-control select2">
                                        <option value="">-- Pilih Status Hubungan --</option>
                                        @foreach ($status_hubungan as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('status_hubungan') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_hubungan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Status Perkawinan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_perkawinan" class="form-control select2">
                                        <option value="">-- Pilih Status Perkawinan --</option>
                                        @foreach ($status_perkawinan as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('status_perkawinan') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_perkawinan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Status Warga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_warga" class="form-control select2">
                                        <option value="">-- Pilih Status Warga --</option>
                                        @foreach ($status_warga as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('status_warga') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_warga')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INDIKATOR KESEJAHTERAAN MASYARAKAT --}}
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Indikator Kesejahteraan Masyarakat</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionKategori">
                            <div class="row">
                                @foreach ($kategoris->groupBy('tipe') as $tipe => $items)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header p-2" id="heading-{{ $tipe }}">
                                                <h6 class="mb-0">
                                                    <button class="btn btn-link text-left w-100" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse-{{ $tipe }}"
                                                        aria-expanded="false">
                                                        {{ strtoupper($tipe) }}
                                                    </button>
                                                </h6>
                                            </div>

                                            <div id="collapse-{{ $tipe }}" class="collapse"
                                                data-parent="#accordionKategori">
                                                <div class="card-body">
                                                    @foreach ($items as $kategori)
                                                        <div class="form-group mb-2">
                                                            <label class="small">{{ $kategori->nama }}</label>
                                                            <select name="kategori[{{ $kategori->id }}]"
                                                                class="form-control form-control-sm">

                                                                <option value="" selected>-- Pilih --</option>

                                                                @if ($kategori->tipe === 'hunian')
                                                                    <option value="layak"
                                                                        {{ old("kategori.$kategori->id") == 'layak' ? 'selected' : '' }}>
                                                                        Layak Huni</option>
                                                                    <option value="tidak_layak"
                                                                        {{ old("kategori.$kategori->id") == 'tidak_layak' ? 'selected' : '' }}>
                                                                        Tidak Layak Huni</option>
                                                                @else
                                                                    <option value="ya"
                                                                        {{ old("kategori.$kategori->id") == 'ya' ? 'selected' : '' }}>
                                                                        Ya</option>
                                                                    <option value="tidak"
                                                                        {{ old("kategori.$kategori->id") == 'tidak' ? 'selected' : '' }}>
                                                                        Tidak</option>
                                                                @endif

                                                            </select>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <a href="{{ route('warga.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-users mr-1"></i> Daftar Warga</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
