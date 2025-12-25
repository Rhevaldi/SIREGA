@extends('layouts.app')

@section('title', 'Data Warga')
@section('page-title', 'Data Warga')

@section('content')

    <div class="card">




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
                                        {{ substr($warga->no_kk, 0, 4) . '********' . substr($warga->no_kk, -4) }}

                                    </span>
                                    <hr class="my-0 border-dark">
                                    {{ substr($warga->nik, 0, 4) . '********' . substr($warga->nik, -4) }}

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

    @include('warga.show')
    @include('kk.show')

@endsection
