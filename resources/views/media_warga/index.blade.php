@extends('layouts.app')

@section('title', 'Media Warga')
@section('page-title', 'Data Media Warga')

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('media_warga.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Upload File
            </a>
        </div>


        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Warga</th>
                        <th>File</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medias as $media)
                        <tr>
                            <td>{{ $media->id }}</td>
                            <td>{{ $media->warga->nama ?? 'N/A' }}</td>
                             <td>
                                @if (in_array($media->file_type, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $media->file_path) }}" width="80"
                                        class="mb-1"><br>
                                @endif
                                <a href="{{ asset('storage/' . $media->file_path) }}" target="_blank">
                                    {{ $media->file_name }}
                                </a>
                            </td>

                           

                            <td>{{ $media->keterangan }}</td>
                            
                            <td>
                                <a href="{{ route('media_warga.edit', $media->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('media_warga.destroy', $media->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin hapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada file</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
