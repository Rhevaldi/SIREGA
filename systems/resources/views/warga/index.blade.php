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

            <div class="table-responsive">
                <table class="table table-bordered table-striped defaultDataTable table-hover nowrap">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            {{-- <th>No. KK</th> --}}
                            <th>
                                Nama Lengkap
                                <hr class="my-0 border-dark">
                                Status
                            </th>
                            <th>
                                No. KK
                                <hr class="my-0 border-dark">
                                NIK
                            </th>
                            <th>Jenis<br>Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan</th>
                            <th>Status<br>Warga</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wargas as $warga)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $warga->nama }}
                                    <hr class="my-0 border-dark">
                                    <span class="badge badge-dark text-muted text-white text-xs">
                                        {{ $warga->status_perkawinan }}
                                    </span>
                                    <span class="badge badge-info text-muted text-white text-xs">
                                        {{ $warga->status_hubungan }}
                                    </span>
                                </td>
                                <td>
                                    <span class="font-weight-bold">
                                        {{ $warga->no_kk }}
                                    </span>
                                    <hr class="my-0 border-dark">
                                    {{ $warga->nik }}
                                </td>
                                <td>{{ $warga->jenis_kelamin }}</td>
                                <td>{{ $warga->tempat_lahir }}</td>
                                <td>{{ $warga->tanggal_lahir->format('d-m-Y') }}</td>
                                <td>{{ $warga->agama }}</td>
                                <td>{{ $warga->pendidikan }}</td>
                                <td>{{ $warga->pekerjaan?->nama }}</td>
                                <td class="text-capitalize">
                                    {{ $warga->status_warga }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#detailModal{{ $warga->id }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu py-0" role="menu" style="">
                                            <a class="dropdown-item btnShowKK" href="javascript:;"
                                                data-id="{{ $warga->kartuKeluarga->id }}">
                                                <i class="fas fa-users mr-1"></i> Data Keluarga
                                            </a>
                                            <a class="dropdown-item" href="{{ route('warga.edit', $warga->id) }}">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('warga.destroy', $warga->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data warga ini?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit" href="javascript:;">
                                                    {{-- <button type="submit" class="btn btn-danger btn-sm text-nowrap d-none"> --}}
                                                    <i class="fas fa-trash mr-2"></i> Hapus
                                                    {{-- </button> --}}
                                                </button>
                                            </form>
                                            {{-- <i class="fas fa-trash"></i> Hapus --}}
                                        </div>
                                    </div>
                                    {{-- <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-secondary btn-sm text-nowrap btnShowKK"
                                            data-id="{{ $warga->kartuKeluarga->id }}">
                                            <i class="fas fa-users"></i> Keluarga
                                        </button>


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
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    {{-- ================= MODAL DETAIL KELUARGA  ================= --}}
    {{-- <div class="modal fade" id="keluargaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Data Anggota Keluarga</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>No KK</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Status Hubungan</th>
                                <th>Status Warga</th>
                            </tr>
                        </thead>
                        <tbody id="keluargaBody">
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Memuat data...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- ================= MODAL DETAIL WARGA ================= --}}
    @foreach ($wargas as $warga)
        <div class="modal fade" id="detailModal{{ $warga->id }}" tabindex="-1" data-backdrop="static"
            data-keyboard="false">
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
                            <div class="col-12">
                                <h6>
                                    <strong>Informasi Detail Warga</strong>
                                </h6>
                                <div class="row">
                                    <div class="col-6">

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
                                        </table>
                                    </div>
                                    <div class="col-6">

                                        <table class="table table-sm table-borderless table-striped">
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td class="text-uppercase">: {{ $warga->pendidikan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td class="text-uppercase">: {{ $warga->pekerjaan->nama }}</td>
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
                                                <td>: {{ $warga->kartuKeluarga?->alamat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>RT/RW</th>
                                                <td>:
                                                    {{ $warga->kartuKeluarga?->rt ?? '-' }}/{{ $warga->kartuKeluarga?->rw ?? '-' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
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

                            <div class="col-6">
                                <h6>
                                    <strong>Penerima Bansos</strong>
                                    <a href="" class="text-xs float-right text-primary" data-toggle="modal"
                                        data-target="#bansosModal{{ $warga->id }}">
                                        <i class="fas fa-plus"></i> Tambah Bansos
                                    </a>
                                </h6>
                                {{-- <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#bansosModal{{ $warga->id }}">
                                        <i class="fas fa-plus"></i> Tambah Bansos
                                    </button> --}}
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

                            {{-- <div class="col-md-6">
                                <strong>Koordinat Lokasi Rumah</strong>
                                <div id="map" data-latitude="{{ $warga->kartuKeluarga?->latitude }}"
                                    data-longitude="{{ $warga->kartuKeluarga?->longitude }}"
                                    style="height:300px;border:1px solid #ddd">
                                </div>
                            </div> --}}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ================= MODAL INPUT BANSOS ================= --}}
        <div class="modal fade" id="bansosModal{{ $warga->id }}" tabindex="-1" data-backdrop="static"
            data-keyboard="false">
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
                                    <option value="calon penerima">Calon Penerima</option>
                                    <option value="penerima">Penerima</option>
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

    @include('kk.show')

@endsection



@push('js')
@endpush
