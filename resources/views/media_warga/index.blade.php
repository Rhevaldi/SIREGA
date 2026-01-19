@extends('layouts.app')

@section('title', 'Media Warga')
@section('page-title', 'Data Media Warga')

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('media_warga.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Upload File
            </a>
        </div>


        <div class="card-body table-responsive">
            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered table-striped defaultDataTable" style="width: 100% !important;">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>No. Kartu Keluarga</th>
                        <th>Kepala Keluarga</th>
                        <th class="text-center">Jumlah Dokumen</th>
                        <th style="width: 500px;">Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medias as $media)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $media->kartuKeluarga->no_kk ?? '-' }}
                            </td>
                            <td class="text-nowrap">
                                {{ $media->kartuKeluarga->nama_kepala_keluarga ?? 'null' }}
                            </td>
                            <td class="text-center">
                                {{ $media->kartuKeluarga->media->count() }}
                            </td>
                            <td>
                                <div uk-lightbox="slidenav: false; nav: thumbnav">
                                    <ul class="list-inline mb-0">
                                        @foreach ($media->kartuKeluarga->media->take(5) as $item)
                                            <li class="list-inline-item">
                                                <a href="/storage/{{ $item->file_path }}"
                                                    data-caption="{{ $item->keterangan }}">
                                                    <img alt="Avatar" class="table-avatar img-fixed img-thumbnail"
                                                        style="width: 2.3rem !important; height: 2.3rem !important; border-radius: 50%;"
                                                        src="/storage/{{ $item->file_path }}">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            {{-- <td>
                                @if (in_array($media->file_type, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $media->file_path) }}" width="80" class="mb-1"><br>
                                @endif
                                <a href="{{ asset('storage/' . $media->file_path) }}" target="_blank">
                                    {{ $media->file_name }}
                                </a>
                            </td> --}}
                            {{-- <td>{{ $media->keterangan }}</td> --}}
                            <td class="text-nowrap">
                                <div class="btn-group" role="group">
                                    <button type="button" id="showMedia" data-id="{{ $media->id }}"
                                        class="btn btn-info btn-sm btn-flat">
                                        <i class="fas fa-eye"></i> Detail Media
                                        {{-- <a href="{{ route('media_warga.edit', $media->id) }}" class="btn btn-warning btn-sm">
                                        Detail Media
                                    </a>  --}}
                                    </button>
                                    <form action="{{ route('media_warga.destroy', $media->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin hapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm btn-flat">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- </div> --}}
        </div>
    </div>

    <!-- Media Modal -->
    <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby
        ="mediaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediaModalLabel">Detail Media Warga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Media content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                // show media on modal
                $(document).on('click', '#showMedia', function() {
                    var mediaId = $(this).data('id');
                    $.ajax({
                        url: '/media_warga/' + mediaId,
                        type: 'GET',
                        success: function(response) {
                            var mediaList = response.medias;
                            var modalBody = '';
                            if (mediaList.length > 0) {
                                modalBody +=
                                    '<div class="row" uk-lightbox="slidenav: false; nav: thumbnav">';
                                mediaList.forEach(function(media) {
                                    if (['jpg', 'jpeg', 'png'].includes(media.file_type)) {
                                        modalBody +=
                                            '<div class="col-md-4 text-center">';
                                        modalBody += '<a href="/storage/' + media
                                            .file_path + '" data-caption="' + media
                                            .keterangan + '">';
                                        modalBody += '<img src="/storage/' + media
                                            .file_path +
                                            '" width="200" class="img-fixed mb-1"><br>';
                                        modalBody += '</a>';
                                        modalBody += '<a href="/storage/' + media
                                            .file_path + '" target="_blank">' + media
                                            .file_name + '.' + media.file_type + '</a>';
                                        modalBody += '<p class="mb-0">' + media.keterangan +
                                            '</p>';
                                        modalBody += '</div>';
                                    } else {
                                        modalBody += '<div class="mb-3">';
                                        modalBody += '<a href="/storage/' + media
                                            .file_path + '" target="_blank">' + media
                                            .file_name + '</a>';
                                        modalBody += '</div>';
                                    }
                                });
                                modalBody += '</div>';
                            } else {
                                modalBody = '<p>Tidak ada media tersedia.</p>';
                            }
                            $('#mediaModal .modal-body').html(modalBody);
                            $('#mediaModal').modal('show');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
