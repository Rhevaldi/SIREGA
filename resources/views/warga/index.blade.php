@extends('layouts.app')

@section('title', 'Data Warga')
@section('page-title', 'Data Warga')

@section('content')

    <div class="card">
        <div class="card-header">
            <a href="{{ route('warga.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Warga
            </a>
        </div>



        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <table class="table table-bordered table-striped defaultDataTable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>No. KK</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Status Warga</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wargas as $warga)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $warga->no_kk }}</td>
                            <td>{{ $warga->nik }}</td>
                            <td>{{ $warga->nama }}</td>
                            <td>{{ $warga->alamat }}</td>
                            <td>{{ $warga->pendidikan }}</td>
                            <td>{{ $warga->pekerjaan }}</td>
                            <td class="text-capitalize">
                                {{ $warga->status_warga }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-info btn-sm text-nowrap" data-toggle="modal"
                                        data-target="#detailModal{{ $warga->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>

                                    <a href="{{ route('warga.edit', $warga->id) }}"
                                        class="btn btn-warning btn-sm text-nowrap">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('warga.destroy', $warga->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus data warga ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm text-nowrap">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    @foreach ($wargas as $warga)
        <div class="modal fade" id="detailModal{{ $warga->id }}" tabindex="-1" role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Warga</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{-- Informasi Detail Warga --}}
                            <div class="col-md-6">
                                <h6>
                                    <strong>Informasi Detail Warga</strong>
                                </h6>
                                <table class="table table-sm table-borderless table-striped">
                                    <tr>
                                        <th width="200">No. KK</th>
                                        <td>: {{ $warga->no_kk }}</td>
                                    </tr>
                                    <tr>
                                        <th width="200">NIK</th>
                                        <td>: {{ $warga->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: {{ $warga->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td class="text-uppercase">:
                                            {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td class="text-uppercase">: {{ $warga->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>
                                            : {{ $warga->tanggal_lahir->format('d-m-Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td class="text-uppercase">: {{ $warga->agama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td class="text-uppercase">: {{ $warga->pendidikan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td class="text-uppercase">: {{ $warga->pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Dalam Keluarga</th>
                                        <td class="text-uppercase">: {{ $warga->status_hubungan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Perkawinan</th>
                                        <td class="text-uppercase">: {{ $warga->status_perkawinan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Warga</th>
                                        <td class="text-uppercase">
                                            : {{ $warga->status_warga }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>: {{ $warga->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>RT</th>
                                        <td>: {{ $warga->rt->rt ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>


                            <div class="col-md-6">
                                <h6>
                                    <strong>Indikator Kesejahteraan Masyarakat</strong>
                                </h6>
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grouped = $warga->kategori->groupBy('tipe');
                                        @endphp

                                        @forelse ($grouped as $tipe => $items)
                                            <tr class="bg-light">
                                                <td colspan="2">
                                                    <strong>{{ ucfirst($tipe) }}</strong>
                                                </td>
                                            </tr>


                                            @foreach ($items as $kat)
                                                <tr>
                                                    <td style="padding-left:20px">
                                                        <b>*</b> {{ $kat->nama }}
                                                    </td>
                                                    <td class="text-capitalize">
                                                        {{ $kat->pivot->nilai ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">
                                                    Tidak ada data indikator
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <h6><strong>Penerima Bansos</strong></h6>
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#bansosModal{{ $warga->id }}">
                                        <i class="fas fa-plus"></i> Tambah Bansos
                                    </button>
                                </div>
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jenis Bansos</th>
                                            <th>Tahun</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($warga->bansos as $b)
                                            <tr>
                                                <td>{{ $b->nama_program }}</td>
                                                <td>{{ $b->tahun }}</td>
                                                <td>
                                                    {{ $b->pivot->keterangan ?? '-' }}
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $b->pivot->status }} • {{ $b->pivot->tanggal_penerimaan }}
                                                    </small>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">
                                                    Belum menerima bansos
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <strong>Koordinat Lokasi Rumah</strong>
                                <div id="map" data-latitude="{{ $warga->latitude }}"
                                    data-longitude="{{ $warga->longitude }}" style="height:300px;border:1px solid #ddd">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>


        {{-- ================= MODAL INPUT BANSOS ================= --}}
        <div class="modal fade" id="bansosModal{{ $warga->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('bansos-penerima.store') }}" method="POST">

                    @csrf
                    <input type="hidden" name="warga_id" value="{{ $warga->id }}">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Penerima Bansos</h5>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Program Bansos</label>
                                <select name="bansos_id" class="form-control" required>
                                    <option value="">-- Pilih Program --</option>
                                    @foreach ($bansosList as $b)
                                        <option value="{{ $b->id }}">
                                            {{ $b->nama_program }} ({{ $b->tahun }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="diajukan">Diajukan</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-primary">Simpan</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection



@push('js')
    <script>
        $(document).ready(function() {
            @foreach ($wargas as $warga)
                $('#detailModal{{ $warga->id }}').on('shown.bs.modal', function() {
                    if (!window.map{{ $warga->id }}) {

                        let lat = {{ $warga->latitude ?? null }};
                        let lng = {{ $warga->longitude ?? null }};

                        if (lat && lng) {
                            const mapElement = document.querySelector(
                                '#detailModal{{ $warga->id }} #map');

                            window.map{{ $warga->id }} = L.map(mapElement)
                                .setView([lat, lng], 15);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap'
                            }).addTo(window.map{{ $warga->id }});

                            L.marker([lat, lng]).addTo(window.map{{ $warga->id }});
                        }
                    }
                });
            @endforeach
        })
    </script>
@endpush
