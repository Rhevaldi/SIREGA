@extends('layouts.app')

@section('title', 'Program Bansos')
@section('page-title', 'Program Bansos')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('bansos.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Program
            </a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped defaultDataTable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Program</th>
                        <th>Jenis</th>
                        <th>Penyelenggara</th>
                        <th>Tahun</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bansos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_program }}</td>
                            <td>{{ ucfirst($item->jenis) }}</td>
                            <td>{{ $item->penyelenggara }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td class="text-center">
                                <a href="{{ route('bansos.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('bansos.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus program bansos ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
