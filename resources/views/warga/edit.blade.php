@extends('layouts.app')

@section('title','Edit Warga')
@section('page-title','Edit Warga')

@section('content')
<form method="POST" action="{{ route('warga.update',$warga->id) }}">
@csrf @method('PUT')

<input class="form-control mb-2" name="nama" value="{{ $warga->nama }}">

<input type="text" id="latitude" name="latitude" value="{{ $warga->latitude }}" readonly class="form-control mb-2">
<input type="text" id="longitude" name="longitude" value="{{ $warga->longitude }}" readonly class="form-control mb-2">

<div id="map" style="height:300px"></div>

<button class="btn btn-primary mt-2">Update</button>
</form>
@endsection

@push('js')
<script>
    var map = L.map('map').setView(
        [{{ $warga->latitude }}, {{ $warga->longitude }}], 16
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker = L.marker(
        [{{ $warga->latitude }}, {{ $warga->longitude }}],
        { draggable:true }
    ).addTo(map);

    marker.on('dragend', function () {
        var pos = marker.getLatLng();
        document.getElementById('latitude').value = pos.lat;
        document.getElementById('longitude').value = pos.lng;
    });
</script>
@endpush
