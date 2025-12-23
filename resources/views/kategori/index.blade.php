@extends('layouts.app')

@section('title', 'Kategori')
@section('page-title', 'Data Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $k)
                        <tr>
                            <td>{{ $k->kode }}</td>
                            <td>{{ $k->nama }}</td>
                            <td>{{ ucfirst($k->tipe) }}</td>
                            <td>{{ $k->deskripsi }}</td>
                            <td>
                                <div class="btn-group" role="group">

                                    <a href="{{ route('kategori.edit', $k->id) }}"
                                        class="btn btn-warning btn-sm text-nowrap">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-nowrap">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
