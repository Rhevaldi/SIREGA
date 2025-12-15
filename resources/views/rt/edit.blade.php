@extends('layouts.app')

@section('title','Edit RT')
@section('page-title','Edit RT')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('rt.update', $rt->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama RT</label>
                <input type="text" name="nama_rt"
                    class="form-control"
                    value="{{ $rt->nama_rt }}" required>
            </div>

            <div class="form-group">
                <label>Wilayah</label>
                <input type="text" name="wilayah"
                    class="form-control"
                    value="{{ $rt->wilayah }}">
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan"
                    class="form-control" rows="3">{{ $rt->keterangan }}</textarea>
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
