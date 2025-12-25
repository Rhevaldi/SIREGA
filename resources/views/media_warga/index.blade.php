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

            <table class="table table-bordered table-striped defaultDataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Warga</th>
                        <th>Jumlah Dokumen</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medias as $media)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $media->warga->nama ?? '-' }}</td>
                            <td>{{ $media->warga->medias->count() }}</td>
                            {{-- <td>
                                @if (in_array($media->file_type, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $media->file_path) }}" width="80" class="mb-1"><br>
                                @endif
                                <a href="{{ asset('storage/' . $media->file_path) }}" target="_blank">
                                    {{ $media->file_name }}
                                </a>
                            </td> --}}
                            {{-- <td>{{ $media->keterangan }}</td> --}}
                            <td>
                                <a href="{{ route('media_warga.edit', $media->id) }}" class="btn btn-warning btn-sm">
                                    Detail Media
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
