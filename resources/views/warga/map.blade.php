@extends('layouts.app')

@section('title','Peta Warga')
@section('page-title','Peta Warga')

@section('content')
<div id="map" style="height:500px"></div>
@endsection

@push('js')
<script>
    var map = L.map('map').setView([-0.4326,116.9853],13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    @foreach($warga as $w)
        L.marker([{{ $w->latitude }}, {{ $w->longitude }}])
            .addTo(map)
            .bindPopup(`<b>{{ $w->nama }}</b><br>{{ $w->alamat }}`);
    @endforeach
</script>
@endpush
