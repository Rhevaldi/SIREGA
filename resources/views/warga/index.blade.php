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


            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th width="80">RT</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wargas as $warga)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $warga->nik }}</td>
                            <td>{{ $warga->nama }}</td>
                            <td>{{ $warga->rt->rt ?? '-' }}</td>
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

            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">


                    <div class="modal-header">
                        <h5 class="modal-title">Detail Warga</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>


                    <div class="modal-body">

                        <table class="table table-sm table-bordered">
                            <tr>
                                <th width="200">NIK</th>
                                <td>{{ $warga->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $warga->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $warga->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <td>{{ $warga->agama }}</td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <td>{{ $warga->pendidikan }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $warga->pekerjaan }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $warga->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th>Status Warga</th>
                                <td>{{ $warga->status_warga }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $warga->alamat }}</td>
                            </tr>
                            <tr>
                                <th>RT</th>
                                <td>{{ $warga->rt->rt ?? '-' }}</td>
                            </tr>
                        </table>

                        <strong>Lokasi Rumah</strong>
                        <div id="map" data-latitude="{{ $warga->latitude }}"
                            data-longitude="{{ $warga->longitude }}" style="height:300px;border:1px solid #ddd"></div>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                    </div>

                </div>
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
