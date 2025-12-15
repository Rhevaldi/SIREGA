@extends('layouts.app')

@section('title','Tambah RT')
@section('page-title','Tambah RT')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('rt.store') }}">
            @csrf

            <div class="form-group">
                <label>Nama RT</label>
                <input name="nama_rt" class="form-control" required>
            </div>            

            <button class="btn btn-success mt-2">Simpan</button>
        </form>
    </div>
</div>
@endsection
