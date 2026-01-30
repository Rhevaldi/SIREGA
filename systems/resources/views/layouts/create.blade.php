@extends('layouts.app')

@section('title', 'Tambah Warga')
@section('page-title', 'Tambah Warga')

@section('content')

    <form action="{{ route('warga.store') }}" method="POST">
        @csrf
        <div class="row">
            {{-- INFORMASI DETAIL WARGA --}}
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Informasi Detail Warga</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>No. Kartu Keluarga</label>
                                    <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk') }}"
                                        autofocus>
                                    @error('no_kk')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
                                    @error('nik')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
                                    @error('nama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="{{ old('tempat_lahir') }}">
                                    @error('tempat_lahir')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir') }}">
                                    @error('tanggal_lahir')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Agama</label>
                                    <input type="text" name="agama" class="form-control" value="{{ old('agama') }}">
                                    @error('agama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Pendidikan</label>
                                    <input type="text" name="pendidikan" class="form-control"
                                        value="{{ old('pendidikan') }}">
                                    @error('pendidikan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="{{ old('pekerjaan') }}">
                                    @error('pekerjaan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Status Hubungan Dalam Keluarga</label>
                                    <select name="status_hubungan" class="form-control text-capitalize">
                                        <option value="">-- Pilih Status Hubungan --</option>
                                        <option value="kepala keluarga"
                                            {{ old('status_hubungan') == 'kepala keluarga' ? 'selected' : '' }}>
                                            kepala keluarga
                                        </option>
                                        <option value="suami" {{ old('status_hubungan') == 'suami' ? 'selected' : '' }}>
                                            suami
                                        </option>
                                        <option value="istri" {{ old('status_hubungan') == 'istri' ? 'selected' : '' }}>
                                            istri
                                        </option>
                                        <option value="anak" {{ old('status_hubungan') == 'anak' ? 'selected' : '' }}>
                                            anak
                                        </option>
                                        <option value="mertua" {{ old('status_hubungan') == 'mertua' ? 'selected' : '' }}>
                                            mertua
                                        </option>
                                        <option value="cucu" {{ old('status_hubungan') == 'cucu' ? 'selected' : '' }}>
                                            cucu
                                        </option>
                                        <option value="orang tua"
                                            {{ old('status_hubungan') == 'orang tua' ? 'selected' : '' }}>
                                            orang tua
                                        </option>
                                        <option value="famili lain"
                                            {{ old('status_hubungan') == 'famili lain' ? 'selected' : '' }}>
                                            famili lain
                                        </option>
                                        <option value="pembantu"
                                            {{ old('status_hubungan') == 'pembantu' ? 'selected' : '' }}>
                                            pembantu
                                        </option>
                                        <option value="lainnya"
                                            {{ old('status_hubungan') == 'lainnya' ? 'selected' : '' }}>
                                            lainnya
                                        </option>
                                    </select>
                                    @error('status_hubungan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Status Perkawinan</label>
                                    <select name="status_perkawinan" class="form-control text-capitalize">
                                        <option value="">-- Pilih --</option>
                                        <option value="kawin" {{ old('status_perkawinan') == 'kawin' ? 'selected' : '' }}>
                                            Kawin
                                        </option>
                                        <option value="belum kawin"
                                            {{ old('status_perkawinan') == 'belum kawin' ? 'selected' : '' }}>
                                            Belum Kawin
                                        </option>
                                        <option value="cerai hidup"
                                            {{ old('status_perkawinan') == 'cerai hidup' ? 'selected' : '' }}>
                                            Cerai Hidup
                                        </option>
                                        <option value="cerai mati"
                                            {{ old('status_perkawinan') == 'cerai mati' ? 'selected' : '' }}>
                                            Cerai Mati
                                        </option>
                                    </select>
                                    @error('status_perkawinan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Status Warga</label>
                                    <select name="status_warga" class="form-control text-capitalize">
                                        <option value="">-- Pilih --</option>
                                        <option value="aktif" {{ old('status_warga') == 'aktif' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="pindah" {{ old('status_warga') == 'pindah' ? 'selected' : '' }}>
                                            Pindah
                                        </option>
                                        <option value="meninggal"
                                            {{ old('status_warga') == 'meninggal' ? 'selected' : '' }}>
                                            Meninggal
                                        </option>
                                        <option value="sementara"
                                            {{ old('status_warga') == 'sementara' ? 'selected' : '' }}>
                                            Sementara
                                        </option>
                                        <option value="tidak diketahui"
                                            {{ old('status_warga') == 'tidak diketahui' ? 'selected' : '' }}>
                                            Tidak Diketahui
                                        </option>
                                        <option value="keluar" {{ old('status_warga') == 'keluar' ? 'selected' : '' }}>
                                            Keluar
                                        </option>
                                        <option value="baru" {{ old('status_warga') == 'baru' ? 'selected' : '' }}>
                                            Baru
                                        </option>
                                        <option value="hilang" {{ old('status_warga') == 'hilang' ? 'selected' : '' }}>
                                            Hilang
                                        </option>
                                        <option value="wna" {{ old('status_warga') == 'wna' ? 'selected' : '' }}>
                                            Warga Negara Asing
                                        </option>
                                    </select>
                                    @error('status_warga')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INDIKATOR KESEJAHTERAAN MASYARAKAT --}}
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Indikator Kesejahteraan Masyarakat</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionKategori">
                            <div class="row">
                                @foreach ($kategoris->groupBy('tipe') as $tipe => $items)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header p-2" id="heading-{{ $tipe }}">
                                                <h6 class="mb-0">
                                                    <button class="btn btn-link text-left w-100" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse-{{ $tipe }}"
                                                        aria-expanded="false">
                                                        {{ strtoupper($tipe) }}
                                                    </button>
                                                </h6>
                                            </div>

                                            <div id="collapse-{{ $tipe }}" class="collapse"
                                                data-parent="#accordionKategori">
                                                <div class="card-body">
                                                    @foreach ($items as $kategori)
                                                        <div class="form-group mb-2">
                                                            <label class="small">{{ $kategori->nama }}</label>
                                                            <select name="kategori[{{ $kategori->id }}]"
                                                                class="form-control form-control-sm">

                                                                <option value="">-- Pilih --</option>

                                                                @if ($kategori->tipe === 'hunian')
                                                                    <option value="layak"
                                                                        {{ old("kategori.$kategori->id") == 'layak' ? 'selected' : '' }}>
                                                                        Layak Huni</option>
                                                                    <option value="tidak_layak"
                                                                        {{ old("kategori.$kategori->id") == 'tidak_layak' ? 'selected' : '' }}>
                                                                        Tidak Layak Huni</option>
                                                                @else
                                                                    <option value="ya"
                                                                        {{ old("kategori.$kategori->id") == 'ya' ? 'selected' : '' }}>
                                                                        Ya</option>
                                                                    <option value="tidak"
                                                                        {{ old("kategori.$kategori->id") == 'tidak' ? 'selected' : '' }}>
                                                                        Tidak</option>
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
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALAMAT WARGA --}}
            <div class="col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Alamat Warga</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>RT</label>
                                    <select class="form-control" disabled>
                                        <option value="">-- Pilih RT --</option>
                                        @foreach ($rts as $rt)
                                            <option value="{{ $rt->id }}" {{ $rt->id == 13 ? 'selected' : '' }}>
                                                {{ $rt->rt }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" name="rt_id" value="13">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        value="{{ old('latitude', '-') }}">
                                    @error('latitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        value="{{ old('longitude', '-') }}">
                                    @error('longitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

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

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <a href="{{ route('warga.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-users mr-1"></i> Daftar Warga</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

    @push('js')
        <script>
            // 1. Ambil nilai dari Laravel, beri fallback string kosong jika null
            let latRaw = "{{ old('latitude') }}";
            let lngRaw = "{{ old('longitude') }}";

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
