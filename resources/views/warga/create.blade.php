@extends('layouts.app')

@section('title', 'Tambah Warga')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Warga</h3>
        </div>

        <form method="POST" action="{{ route('warga.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK" required>
                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No KK</label>
                            <input type="text" name="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga"
                                required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="Nomor Handphone"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat tempat tinggal" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>RT</label>
                            <select name="rt_id" class="form-control" required>
                                <option value="">-- Pilih RT --</option>
                                @foreach ($rt as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama_rt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status Warga</label>
                            <select name="status_warga" class="form-control" required>
                                <option value="aktif">Aktif</option>
                                <option value="pindah">Pindah</option>
                                <option value="meninggal">Meninggal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <button type="button" class="btn btn-info btn-sm" onclick="getLocation()">
                        <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saya
                    </button>
                </div>


                <div class="form-group">
                    <label>Tandai Lokasi Rumah</label>
                    <div id="map" style="height: 350px;"></div>
                </div>

                <div class="form-group">
                    <label>Foto Rumah</label>
                    <input type="file" name="foto_rumah" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Foto Warga</label>
                    <input type="file" name="foto_warga" class="form-control-file">
                </div>

            </div>

            <div class="card-footer text-right">
                <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        var defaultLat = -0.4326;
        var defaultLng = 116.9853;

        var map = L.map('map').setView([defaultLat, defaultLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([defaultLat, defaultLng], {
            draggable: true
        }).addTo(map);

        function setLatLng(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        
        map.on('click', function(e) {
            setLatLng(e.latlng.lat, e.latlng.lng);
        });

        
        marker.on('dragend', function() {
            var pos = marker.getLatLng();
            setLatLng(pos.lat, pos.lng);
        });

        
        function getLocation() {
            if (!navigator.geolocation) {
                alert('Browser tidak mendukung GPS');
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    setLatLng(
                        position.coords.latitude,
                        position.coords.longitude
                    );
                },
                function() {
                    alert('Gagal mengambil lokasi. Aktifkan GPS.');
                }
            );
        }

        
        setLatLng(defaultLat, defaultLng);
    </script>
@endpush
