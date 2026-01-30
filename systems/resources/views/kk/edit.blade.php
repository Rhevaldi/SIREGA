@extends('layouts.app')

@section('title', 'Edit Kartu Keluarga')
@section('page-title', 'Edit Kartu Keluarga')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title mt-1">Form Edit Kartu Keluarga</h3>
                    <a href="{{ route('kk.index') }}" class="btn btn-sm btn-secondary float-right">
                        <i class="fas fa-arrow-left"></i> Daftar Kartu Keluarga
                    </a>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('kk.update', $kartuKeluarga->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_kk">
                                        No. Kartu Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input value="{{ $kartuKeluarga->no_kk }}" type="text" id="no_kk" name="no_kk"
                                        class="form-control" placeholder="Masukkan No. KK" autofocus>
                                    @error('no_kk')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_dikeluarkan">
                                        Tanggal Terbit KK <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input value="{{ $kartuKeluarga->tanggal_dikeluarkan }}" type="date"
                                        id="tanggal_dikeluarkan" name="tanggal_dikeluarkan" class="form-control"
                                        placeholder="Masukkan Tanggal Terbit KK">
                                    @error('tanggal_dikeluarkan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="provinsi">
                                        Provinsi <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="provinsi" class="form-control select2bs4" required>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province['name'] }}"
                                                {{ $province['name'] == $default['province_name'] ? 'selected' : '' }}>
                                                {{ $province['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kabupaten">
                                        Kabupaten/Kota <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="kabupaten" class="form-control select2bs4" required>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city['name'] }}"
                                                {{ $city['name'] == $default['city_name'] ? 'selected' : '' }}>
                                                {{ $city['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kabupaten')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kecamatan">
                                        Kecamatan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="kecamatan" class="form-control select2bs4" required>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district['name'] }}"
                                                {{ $district['name'] == $default['district_name'] ? 'selected' : '' }}>
                                                {{ $district['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kecamatan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="desa">
                                        Desa/Kelurahan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="desa" class="form-control select2bs4" required>
                                        @foreach ($villages as $village)
                                            <option value="{{ $village['name'] }}"
                                                {{ $village['name'] == $default['village_name'] ? 'selected' : '' }}>
                                                {{ $village['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('desa')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="alamat">
                                        Alamat <span class="text-xs text-danger">*</span>
                                    </label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="2"
                                        placeholder="Masukkan Alamat Lengkap (Sesuai KK)">{{ $kartuKeluarga->alamat }}</textarea>
                                    @error('alamat')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rt">
                                        RT
                                    </label>
                                    <input value="{{ $kartuKeluarga->rt }}" type="number" id="rt" name="rt"
                                        class="form-control" placeholder="Masukkan RT (Contoh: 12)">
                                    @error('rt')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="rw">
                                        RW
                                    </label>
                                    <input value="{{ $kartuKeluarga->rw }}" type="number" id="rw" name="rw"
                                        class="form-control" placeholder="Masukkan RW (Contoh: 12)">
                                    @error('rw')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="kode_pos">
                                        Kode Pos
                                    </label>
                                    <input value="{{ $kartuKeluarga->kode_pos }}" type="number" id="kode_pos"
                                        name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos">
                                    @error('kode_pos')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="latitude">
                                        Latitude <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" readonly
                                        value="{{ $kartuKeluarga->latitude }}">
                                    @error('latitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="longitude">
                                        Longitude <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" readonly
                                        value="{{ $kartuKeluarga->longitude }}">
                                    @error('longitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title mt-1">Mapping Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label>
                                    Tandai Lokasi Rumah
                                    <button type="button" class="btn btn-info btn-xs ml-2" onclick="getLocation()">
                                        <i class="fas fa-location-arrow"></i> Gunakan Lokasi Saat Ini
                                    </button>
                                </label>
                                <div id="map" style="height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            // 1. Ambil nilai dari Laravel, beri fallback string kosong jika null
            let latRaw = "{{ $kartuKeluarga->latitude }}";
            let lngRaw = "{{ $kartuKeluarga->longitude }}";

            let lat = parseFloat(latRaw);
            let lng = parseFloat(lngRaw);

            // 2. Tentukan koordinat awal (Default: Jakarta atau tengah Indonesia) 
            // agar map tidak error saat inisialisasi awal
            let defaultLat = -6.200000;
            let defaultLng = 106.816666;

            // 3. Cek apakah koordinat valid (tidak NaN)
            const hasCoords = !isNaN(lat) && !isNaN(lng);

            // Inisialisasi map dengan koordinat yang ada atau default
            const map = L.map('map').setView([hasCoords ? lat : defaultLat, hasCoords ? lng : defaultLng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Inisialisasi marker
            let marker = L.marker([hasCoords ? lat : defaultLat, hasCoords ? lng : defaultLng], {
                draggable: true
            }).addTo(map);

            function updateLatLng(lat, lng) {
                document.getElementById('latitude').value = lat.toFixed(8);
                document.getElementById('longitude').value = lng.toFixed(8);
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 16);
            }

            map.on('click', e => updateLatLng(e.latlng.lat, e.latlng.lng));
            marker.on('dragend', e => updateLatLng(e.target.getLatLng().lat, e.target.getLatLng().lng));

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        pos => updateLatLng(pos.coords.latitude, pos.coords.longitude),
                        () => {
                            alert('Gagal mengambil lokasi. Pastikan GPS aktif dan izin lokasi diberikan.');
                        }
                    );
                } else {
                    alert("Browser Anda tidak mendukung Geolocation.");
                }
            }

            // 4. LOGIKA UTAMA: Jika lat/lng kosong, jalankan getLocation()
            if (!hasCoords) {
                getLocation();
            } else {
                updateLatLng(lat, lng);
            }
        </script>
    @endpush
@endsection
