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
                            <td>
                                <div class="btn-group" role="group">

                                    <a href="{{ route('bansos.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm text-nowrap">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('bansos.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus program bansos ini?')"
                                        class="d-inline">
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
