@extends('layouts.app')

@section('title', 'Edit Warga')
@section('page-title', 'Edit Warga')

@section('content')
    <form action="{{ route('warga.update', $warga->id) }}" method="POST">
        @csrf
        @method('PUT')

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
                                    <input type="text" name="no_kk" class="form-control"
                                        value="{{ old('no_kk', $warga->no_kk) }}" autofocus>
                                    @error('no_kk')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" value="{{ $warga->nik }}"
                                        autofocus>
                                    @error('nik')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $warga->nama }}">
                                    @error('nama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="{{ $warga->tempat_lahir }}">
                                    @error('tempat_lahir')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ $warga->tanggal_lahir->format('Y-m-d') }}">
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
                                        <option value="L" {{ $warga->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-laki
                                        </option>
                                        <option value="P" {{ $warga->jenis_kelamin == 'P' ? 'selected' : '' }}>
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
                                    <input type="text" name="agama" class="form-control" value="{{ $warga->agama }}">
                                    @error('agama')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Pendidikan</label>
                                    <input type="text" name="pendidikan" class="form-control"
                                        value="{{ $warga->pendidikan }}">
                                    @error('pendidikan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="{{ $warga->pekerjaan }}">
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
                                            {{ $warga->status_hubungan == 'kepala keluarga' ? 'selected' : '' }}>
                                            kepala keluarga
                                        </option>
                                        <option value="suami" {{ $warga->status_hubungan == 'suami' ? 'selected' : '' }}>
                                            suami
                                        </option>
                                        <option value="istri" {{ $warga->status_hubungan == 'istri' ? 'selected' : '' }}>
                                            istri
                                        </option>
                                        <option value="anak" {{ $warga->status_hubungan == 'anak' ? 'selected' : '' }}>
                                            anak
                                        </option>
                                        <option value="mertua" {{ $warga->status_hubungan == 'mertua' ? 'selected' : '' }}>
                                            mertua
                                        </option>
                                        <option value="cucu" {{ $warga->status_hubungan == 'cucu' ? 'selected' : '' }}>
                                            cucu
                                        </option>
                                        <option value="orang tua"
                                            {{ $warga->status_hubungan == 'orang tua' ? 'selected' : '' }}>
                                            orang tua
                                        </option>
                                        <option value="famili lain"
                                            {{ $warga->status_hubungan == 'famili lain' ? 'selected' : '' }}>
                                            famili lain
                                        </option>
                                        <option value="pembantu"
                                            {{ $warga->status_hubungan == 'pembantu' ? 'selected' : '' }}>
                                            pembantu
                                        </option>
                                        <option value="lainnya"
                                            {{ $warga->status_hubungan == 'lainnya' ? 'selected' : '' }}>
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
                                    <select name="status_perkawinan" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="kawin"
                                            {{ $warga->status_perkawinan == 'kawin' ? 'selected' : '' }}>
                                            Kawin
                                        </option>
                                        <option value="belum kawin"
                                            {{ $warga->status_perkawinan == 'belum kawin' ? 'selected' : '' }}>
                                            Belum Kawin
                                        </option>
                                        <option value="cerai hidup"
                                            {{ $warga->status_perkawinan == 'cerai hidup' ? 'selected' : '' }}>
                                            Cerai Hidup
                                        </option>
                                        <option value="cerai mati"
                                            {{ $warga->status_perkawinan == 'cerai mati' ? 'selected' : '' }}>
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
                                    <select name="status_warga" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="aktif" {{ $warga->status_warga == 'aktif' ? 'selected' : '' }}>
                                            Aktif
                                        </option>
                                        <option value="pindah" {{ $warga->status_warga == 'pindah' ? 'selected' : '' }}>
                                            Pindah
                                        </option>
                                        <option value="meninggal"
                                            {{ $warga->status_warga == 'meninggal' ? 'selected' : '' }}>
                                            Meninggal
                                        </option>
                                        <option value="sementara"
                                            {{ $warga->status_warga == 'sementara' ? 'selected' : '' }}>
                                            Sementara
                                        </option>
                                        <option value="tidak diketahui"
                                            {{ $warga->status_warga == 'tidak diketahui' ? 'selected' : '' }}>
                                            Tidak Diketahui
                                        </option>
                                        <option value="keluar" {{ $warga->status_warga == 'keluar' ? 'selected' : '' }}>
                                            Keluar
                                        </option>
                                        <option value="baru" {{ $warga->status_warga == 'baru' ? 'selected' : '' }}>
                                            Baru
                                        </option>
                                        <option value="hilang" {{ $warga->status_warga == 'hilang' ? 'selected' : '' }}>
                                            Hilang
                                        </option>
                                        <option value="wna" {{ $warga->status_warga == 'wna' ? 'selected' : '' }}>
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
                                                        @php
                                                            $pivot = $warga->kategori->firstWhere('id', $kategori->id);
                                                            $nilai = $pivot->pivot->nilai ?? '';
                                                        @endphp

                                                        <div class="form-group mb-2">
                                                            <label class="small">{{ $kategori->nama }}</label>
                                                            <select name="kategori[{{ $kategori->id }}]"
                                                                class="form-control form-control-sm">
                                                                <option value="">-- Pilih --</option>
                                                                @if ($kategori->tipe === 'hunian')
                                                                    <option value="layak"
                                                                        {{ $nilai == 'layak' ? 'selected' : '' }}>
                                                                        Layak Huni
                                                                    </option>
                                                                    <option value="tidak_layak"
                                                                        {{ $nilai == 'tidak_layak' ? 'selected' : '' }}>
                                                                        Tidak Layak Huni
                                                                    </option>
                                                                @else
                                                                    <option value="ya"
                                                                        {{ $nilai == 'ya' ? 'selected' : '' }}>
                                                                        Ya
                                                                    </option>
                                                                    <option value="tidak"
                                                                        {{ $nilai == 'tidak' ? 'selected' : '' }}>
                                                                        Tidak
                                                                    </option>
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
                                    <textarea name="alamat" class="form-control">{{ $warga->alamat }}</textarea>
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

                                    <input type="hidden" name="rt_id" value="3">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Latitude</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control"
                                        value="{{ $warga->latitude }}">
                                    @error('latitude')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Longitude</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control"
                                        value="{{ $warga->longitude }}">
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
            let lat = {{ $warga->latitude ?? -0.4326 }};
            let lng = {{ $warga->longitude ?? 116.9853 }};

            const map = L.map('map').setView([lat, lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            function updateLatLng(a, b) {
                document.getElementById('latitude').value = a.toFixed(8);
                document.getElementById('longitude').value = b.toFixed(8);
                marker.setLatLng([a, b]);
                map.setView([a, b], 16);
            }

            map.on('click', e => updateLatLng(e.latlng.lat, e.latlng.lng));
            marker.on('dragend', e => updateLatLng(e.target.getLatLng().lat, e.target.getLatLng().lng));

            function getLocation() {
                navigator.geolocation.getCurrentPosition(
                    pos => updateLatLng(pos.coords.latitude, pos.coords.longitude),
                    () => alert('Gagal mengambil lokasi')
                );
            }
        </script>
    @endpush
@endsection
