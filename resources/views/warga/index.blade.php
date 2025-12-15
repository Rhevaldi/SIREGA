@extends('layouts.app')

@section('title', 'Data Warga')
@section('page-title', 'Data Warga')

@section('content')

    <div class="card">
        
            <div class="card-header">
                <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Warga
                </a>


        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>RT</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @forelse($wargas as $w)
                        <tr>
                            <td>{{ $w->nik }}</td>
                            <td>{{ $w->nama }}</td>
                            <td>{{ $w->rt->nama_rt ?? '-' }}</td>
                            <td>{{ ucfirst($w->status_warga) }}</td>
                            
                                <td>
                                    <a href="{{ route('warga.edit', $w->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form method="POST" action="{{ route('warga.destroy', $w->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Hapus data?')"
                                            class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Data warga belum tersedia</td>
                        </tr>
                    @endforelse
                </tbody>



            </table>
        </div>
    </div>

@endsection
