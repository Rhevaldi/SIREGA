@extends('layouts.app')

@section('title','Edit RT')
@section('page-title','Edit RT')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('rt.update', $rt->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label>Desa</label>
                <select name="desa_id" class="form-control" required>
                    <option value="">Pilih Desa</option>
                    @foreach($desas as $desa)
                        <option value="{{ $desa->id }}"
                            {{ $rt->desa_id == $desa->id ? 'selected' : '' }}>
                            {{ $desa->nama_desa }}
                        </option>
                    @endforeach
                </select>       
            </div>

            <div class="form-group">
                <label>Nama RT</label>
                <input type="text" name="nama_rt"
                    class="form-control"
                    value="{{ $rt->rt }}" required>
            </div>

            <div class="form-group">
                <label>Ketua RT (ID Warga)</label>
                <input type="number" name="ketua_warga_id"
                    class="form-control"
                    value="{{ $rt->ketua_warga_id }}">
            </div>

        

            <div class="text-right">
                <a href="{{ route('rt.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button class="btn btn-success">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
