@extends('layouts.app')

@section('title', 'Data Warga')
@section('page-title', 'Data Warga')

@section('content')

<div class="card">
    <div class="card-header">
        <form method="GET" class="float-left">
            <input type="text" name="keyword"
                   value="{{ request('keyword') }}"
                   placeholder="Cari warga..."
                   class="form-control d-inline w-25">
        </form>

        @if(auth()->user()->role == 'admin')
        <a href="{{ route('warga.create') }}" class="btn btn-primary float-right">
            + Tambah Warga
        </a>
        @endif
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>RT</th>
                    <th>Status</th>
                    @if(auth()->user()->role == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>
            @foreach($warga as $w)
                <tr>
                    <td>
                        {{ auth()->user()->role == 'admin' ? $w->nik : '********' }}
                    </td>
                    <td>{{ $w->nama }}</td>
                    <td>{{ $w->rt->nama_rt ?? '-' }}</td>
                    <td>{{ ucfirst($w->status_warga) }}</td>

                    @if(auth()->user()->role == 'admin')
                    <td>
                        <a href="{{ route('warga.edit', $w->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form method="POST"
                              action="{{ route('warga.destroy', $w->id) }}"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus data?')"
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>

@endsection
