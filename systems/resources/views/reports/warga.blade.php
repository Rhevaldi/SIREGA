@extends('layouts.app')

@section('title', 'Laporan Data Warga')
@section('page-title', 'Laporan Data Warga')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="callout callout-warning">
                <h5>
                    <i class="fas fa-file-archive mr-1"></i>
                    Ringkasan Laporan
                </h5>
                <p>Berikut adalah ringkasan laporan data warga yang dapat Anda filter berdasarkan tanggal
                    tertentu. Gunakan form di sebelah kanan untuk memilih rentang tanggal yang diinginkan,
                    kemudian klik tombol <strong>"Generate Laporan"</strong> untuk melihat hasilnya.</p>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kepala Keluarga</span>
                            <span class="info-box-number">{{ number_format($totalKK) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Warga</span>
                            <span class="info-box-number">{{ number_format($totalWarga) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning">
                            <i class="fas fa-male"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Laki - Laki</span>
                            <span class="info-box-number">{{ number_format($totalLaki) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger">
                            <i class="fas fa-female"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Perempuan</span>
                            <span class="info-box-number">{{ number_format($totalPerempuan) }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-filter mr-1"></i>
                        Filterisasi Laporan
                    </h3>
                </div>
                <form action="{{ route('reports.warga') }}" method="GET">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control select2bs4">
                                        <option value="all"
                                            {{ request('jenis_kelamin', 'all') === 'all' ? 'selected' : '' }}>
                                            Semua Jenis Kelamin
                                        </option>
                                        @foreach ($jenisKelaminList as $jenis_kelamin)
                                            <option value="{{ $jenis_kelamin }}"
                                                {{ request('jenis_kelamin') === $jenis_kelamin ? 'selected' : '' }}>
                                                {{ $jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_kelamin')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Warga</label>
                                    <select name="status_warga" class="form-control select2bs4" required>
                                        <option value="all"
                                            {{ request('status_warga', 'all') === 'all' ? 'selected' : false }}>
                                            Semua
                                            Status Warga</option>
                                        @foreach ($statusWargaList as $status_warga)
                                            <option value="{{ $status_warga }}"
                                                {{ request('status_warga') === $status_warga ? 'selected' : false }}>
                                                {{ $status_warga }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_warga')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status Hubungan</label>
                                    <select name="status_hubungan" class="form-control select2bs4" required>
                                        <option value="all"
                                            {{ request('status_hubungan', 'all') === 'all' ? 'selected' : false }}>
                                            Semua Status Hubungan</option>
                                        @foreach ($statusHubunganList as $status_hubungan)
                                            <option value="{{ $status_hubungan }}"
                                                {{ request('status_hubungan') === $status_hubungan ? 'selected' : false }}>
                                                {{ $status_hubungan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_hubungan')
                                        <p class="text-sm text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Generate Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Laporan Data Warga
                    </h3>
                    <button class="btn btn-sm btn-success float-right" onclick="cetakLaporan()">
                        <i class="fas fa-print mr-1"></i>
                        Cetak Laporan
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover reportsTable nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Status Warga</th>
                                    <th>Status Hubungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($isFiltered && $wargas->count())
                                    @foreach ($wargas->groupBy('no_kk') as $noKK => $anggota)
                                        {{-- ROW HEADER KK --}}
                                        <tr class="bg-light font-weight-bold">
                                            <td colspan="11">
                                                No. Kartu Keluarga : {{ $noKK }}
                                            </td>
                                        </tr>

                                        {{-- DATA ANGGOTA KELUARGA --}}
                                        @foreach ($anggota as $data)
                                            <tr class="text-uppercase">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $data->nik }}</td>
                                                <td>{{ $data->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>{{ $data->tempat_lahir }}</td>
                                                <td>{{ $data->tanggal_lahir->format('d-m-Y') }}</td>
                                                <td>{{ $data->agama }}</td>
                                                <td>{{ $data->pendidikan }}</td>
                                                 <td>{{ $data->pekerjaan?->nama }}</td>
                                                <td>{{ $data->status_warga }}</td>
                                                <td>{{ $data->status_hubungan }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            Tidak ada data untuk ditampilkan.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    @push('js')
        <script>
            function cetakLaporan() {
                const queryString = window.location.search;

                if (!queryString) {
                    alert('Silakan lakukan filter terlebih dahulu sebelum mencetak laporan.');
                    return;
                }

                const url = "{{ route('reports.warga.cetak') }}" + queryString;

                // Buka tab baru
                window.open(url, '_blank');
            }
        </script>
    @endpush
@endsection
