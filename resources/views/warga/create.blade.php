@extends('layouts.app')

@section('title', 'Tambah Warga')
@section('page-title', 'Tambah Warga')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                </div>

                <div class="form-group mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                </div>

                <div class="form-group mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Agama</label>
                    <input type="text" name="agama" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Pendidikan</label>
                    <input type="text" name="pendidikan" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control">
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Status Perkawinan</label>
                        <select name="status_perkawinan" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="belum menikah">Belum Menikah</option>
                            <option value="menikah">Menikah</option>
                            <option value="cerai">Cerai</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Status Warga</label>
                        <select name="status_warga" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="aktif">Aktif</option>
                            <option value="pindah">Pindah</option>
                            <option value="meninggal">Meninggal</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <hr>
                <label>Kategori Warga</label>x  

                <div class="accordion" id="accordionKategori">
                    @foreach ($kategoris->groupBy('tipe') as $tipe => $items)
                        <div class="card">
                            <div class="card-header p-2" id="heading-{{ $tipe }}">
                                <h6 class="mb-0">
                                    <button class="btn btn-link text-left w-100" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{ $tipe }}" aria-expanded="false">
                                        {{ strtoupper($tipe) }}
                                    </button>
                                </h6>
                            </div>

                            <div id="collapse-{{ $tipe }}" class="collapse" data-parent="#accordionKategori">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($items as $kategori)
                                            <div class="col-md-6 mb-2">
                                                <label class="small">{{ $kategori->nama }}</label>
                                                <select name="kategori[{{ $kategori->id }}]"
                                                    class="form-control form-control-sm">

                                                    <option value="">-- Pilih --</option>

                                                    @if ($kategori->tipe === 'hunian')
                                                        <option value="layak">Layak Huni</option>
                                                        <option value="tidak_layak">Tidak Layak Huni</option>
                                                    @else
                                                        <option value="ya">Ya</option>
                                                        <option value="tidak">Tidak</option>
                                                    @endif

                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>





                <div class="form-group mb-3">
                    <label>RT</label>
                    <select name="rt_id" class="form-control">
                        <option value="">-- Pilih RT --</option>
                        @foreach ($rts as $rt)
                            <option value="{{ $rt->id }}">{{ $rt->rt }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Latitude</label>
                        <input type="text" id="latitude" name="latitude" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>Longitude</label>
                        <input type="text" id="longitude" name="longitude" class="form-control" readonly>
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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            let lat = -0.4326;
            let lng = 116.9853;

            const map = L.map('map').setView([lat, lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
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
                navigator.geolocation.getCurrentPosition(
                    pos => updateLatLng(pos.coords.latitude, pos.coords.longitude),
                    () => alert('Gagal mengambil lokasi')
                );
            }

            updateLatLng(lat, lng);
        </script>
    @endpush
@endsection
