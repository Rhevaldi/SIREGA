@extends('layouts.app')

@section('title', 'Data Kartu Keluarga')
@section('page-title', 'Data Kartu Keluarga')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-1">Daftar Kartu Keluarga</h3>
                    <a href="{{ route('kk.create') }}" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-plus"></i> KK Baru
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="kkTable" class="table table-bordered table-hover defaultDataTable">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>No KK</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Desa/Kelurahan</th>
                                <th class="text-center">Latitude</th>
                                <th class="text-center">Longitude</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kk)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $kk->no_kk }}
                                    </td>
                                    <td>
                                        {{ $kk->nama_kepala_keluarga ?? 'null' }}
                                    </td>
                                    <td>
                                        {{ $kk->desa }}
                                    </td>
                                    <td class="text-center">
                                        {{ $kk->latitude }}
                                    </td>
                                    <td class="text-center">
                                        {{ $kk->longitude }}
                                    </td>
                                    <td class="project-actions text-center">
                                        <a class="btn btn-info btn-xs" href="{{ route('kk.edit', $kk->id) }}">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('kk.destroy', $kk->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">#</th>
                                <th>No KK</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Desa/Kelurahan</th>
                                <th class="text-center">Latitude</th>
                                <th class="text-center">Longitude</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection
