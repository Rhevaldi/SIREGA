@extends('layouts.app')

@section('title', 'Data RT')
@section('page-title', 'Data RT')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('rt.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah RT
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama RT</th>
                    <th>Desa</th>
                    <th>Ketua RT</th>
                    <th>Jumlah Warga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rts as $rt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rt->rt }}</td>
                    <td>{{ $rt->desa->nama_desa }}</td>
                    <td>{{ $rt->ketua?->nama ?? '-' }}</td>
                    <td>{{ $rt->warga_count }}</td>
                    <td>
                        <a href="{{ route('rt.edit', $rt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rt.destroy', $rt->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus RT ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
