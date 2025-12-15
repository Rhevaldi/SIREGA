@extends('layouts.app')

@section('title','Data RT')
@section('page-title','Data RT')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('rt.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah RT
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama RT</th>
                    <th>Jumlah Warga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($rt as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_rt }}</td>
                    <td>{{ $item->warga_count }}</td>
                    <td>
                        <a href="{{ route('rt.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('rt.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus RT ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($rt->isEmpty())
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Data RT belum tersedia
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
