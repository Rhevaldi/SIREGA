@extends('layouts.app')

@section('title', 'Edit Media Warga')
@section('page-title', 'Edit Media Warga')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('media_warga.update', $mediaWarga->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Warga</label>
                <select name="warga_id" class="form-control" required>
                    @foreach($wargas as $warga)
                        <option value="{{ $warga->id }}"
                            {{ $mediaWarga->warga_id == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nik }} - {{ $warga->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label>File (kosongkan jika tidak diganti)</label>
                <input type="file" name="file" class="form-control">
                <small class="text-muted">
                    File saat ini:
                    <a href="{{ asset('storage/'.$mediaWarga->file_path) }}" target="_blank">
                        {{ $mediaWarga->file_name }}
                    </a>
                </small>
            </div>

            <div class="form-group mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">
                    {{ $mediaWarga->keterangan }}
                </textarea>
            </div>

            <div class="text-right">
                <a href="{{ route('media_warga.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
