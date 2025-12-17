@extends('layouts.app')

@section('title', 'Desa')
@section('page-title', 'Data Desa')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('desa.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Desa
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped defaultDataTable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($desa as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_desa }}</td>
                            <td>{{ $item->kecamatan ?? '-' }}</td>
                            <td>{{ $item->kabupaten ?? '-' }}</td>
                            <td>{{ $item->provinsi ?? '-' }}</td>
                            <td>
                                <a href="{{ route('desa.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('desa.destroy', $item->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin hapus Desa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data Desa belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
