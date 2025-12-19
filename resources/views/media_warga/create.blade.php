@extends('layouts.app')

@section('title', 'Tambah Media Warga')
@section('page-title', 'Tambah Media Warga')

@section('content')
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('media_warga.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label>Warga</label>
                    <select name="warga_id" class="form-control" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach ($wargas as $warga)
                            <option value="{{ $warga->id }}">
                                {{ $warga->nik }} - {{ $warga->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>

                <div class="text-right">
                    <a href="{{ route('media_warga.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection
