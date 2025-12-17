@extends('layouts.app')

@section('title', 'Edit Warga')
@section('page-title', 'Edit Warga')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('warga.update', $warga->id) }}" method="POST">
            @csrf
            @method('PUT')


            <div class="form-group mb-3">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control"
                       value="{{ old('nik', $warga->nik) }}">
            </div>


            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama', $warga->nama) }}">
            </div>


            <div class="form-group mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin)=='L'?'selected':'' }}>
                        Laki-laki
                    </option>
                    <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin)=='P'?'selected':'' }}>
                        Perempuan
                    </option>
                </select>
            </div>

        
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control"
                           value="{{ old('tempat_lahir', $warga->tempat_lahir) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control"
                           value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($warga->tanggal_lahir)->format('Y-m-d')) }}">
                </div>
            </div>


            <div class="form-group mb-3">
                <label>Agama</label>
                <input type="text" name="agama" class="form-control"
                       value="{{ old('agama', $warga->agama) }}">
            </div>


            <div class="form-group mb-3">
                <label>Pendidikan</label>
                <input type="text" name="pendidikan" class="form-control"
                       value="{{ old('pendidikan', $warga->pendidikan) }}">
            </div>


            <div class="form-group mb-3">
                <label>Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control"
                       value="{{ old('pekerjaan', $warga->pekerjaan) }}">
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Status Perkawinan</label>
                    <select name="status_perkawinan" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="belum menikah" {{ old('status_perkawinan',$warga->status_perkawinan)=='belum menikah'?'selected':'' }}>Belum Menikah</option>
                        <option value="menikah" {{ old('status_perkawinan',$warga->status_perkawinan)=='menikah'?'selected':'' }}>Menikah</option>
                        <option value="cerai" {{ old('status_perkawinan',$warga->status_perkawinan)=='cerai'?'selected':'' }}>Cerai</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status Warga</label>
                    <select name="status_warga" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="aktif" {{ old('status_warga',$warga->status_warga)=='aktif'?'selected':'' }}>Aktif</option>
                        <option value="pindah" {{ old('status_warga',$warga->status_warga)=='pindah'?'selected':'' }}>Pindah</option>
                        <option value="meninggal" {{ old('status_warga',$warga->status_warga)=='meninggal'?'selected':'' }}>Meninggal</option>
                    </select>
                </div>
            </div>


            <div class="form-group mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ old('alamat', $warga->alamat) }}</textarea>
            </div>


            <div class="form-group mb-3">
                <label>RT</label>
                <select name="rt_id" class="form-control">
                    <option value="">-- Pilih RT --</option>
                    @foreach($rts as $rt)
                        <option value="{{ $rt->id }}"
                            {{ old('rt_id', $warga->rt_id)==$rt->id?'selected':'' }}>
                            {{ $rt->rt }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Latitude</label>
                    <input type="text" id="latitude" name="latitude"
                           class="form-control" readonly
                           value="{{ old('latitude', $warga->latitude) }}">
                </div>
                <div class="col-md-6">
                    <label>Longitude</label>
                    <input type="text" id="longitude" name="longitude"
                           class="form-control" readonly
                           value="{{ old('longitude', $warga->longitude) }}">
                </div>
            </div>


            <div class="mb-2">
                <label>Tandai Lokasi Rumah</label>
                <div id="map" style="height:300px;"></div>
            </div>

            <button type="button" class="btn btn-info btn-sm mb-3" onclick="getLocation()">
                <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saya
            </button>

            <div class="text-right">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@push('js')
<script>
    let lat = {{ $warga->latitude ?? -0.4326 }};
    let lng = {{ $warga->longitude ?? 116.9853 }};

    const map = L.map('map').setView([lat, lng], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    let marker = L.marker([lat, lng], { draggable: true }).addTo(map);

    function updateLatLng(a, b) {
        document.getElementById('latitude').value = a.toFixed(8);
        document.getElementById('longitude').value = b.toFixed(8);
        marker.setLatLng([a, b]);
        map.setView([a, b], 16);
    }

    map.on('click', e => updateLatLng(e.latlng.lat, e.latlng.lng));
    marker.on('dragend', e => updateLatLng(e.target.getLatLng().lat, e.target.getLatLng().lng));

    function getLocation() {
        if (!navigator.geolocation) {
            alert('Browser tidak mendukung GPS');
            return;
        }
        navigator.geolocation.getCurrentPosition(
            pos => updateLatLng(pos.coords.latitude, pos.coords.longitude),
            () => alert('Gagal mengambil lokasi')
        );
    }
</script>
@endpush
@endsection
