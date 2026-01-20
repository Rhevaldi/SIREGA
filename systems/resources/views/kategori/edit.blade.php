@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Kode</label>
                <input type="text" name="kode" class="form-control" value="{{ $kategori->kode }}" required>
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
            </div>

            <div class="mb-3">
                <label>Tipe</label>
                <select name="tipe" class="form-control">
                    @foreach(['sosial','ekonomi','hunian','kesehatan','administratif'] as $t)
                        <option value="{{ $t }}" {{ $kategori->tipe==$t?'selected':'' }}>
                            {{ ucfirst($t) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $kategori->deskripsi }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
