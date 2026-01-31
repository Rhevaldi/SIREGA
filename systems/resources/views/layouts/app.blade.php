<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_TITLE') }} @yield('title', 'SIREGA')</title>
    <link rel="shortcut icon" href="{{ asset(env('APP_FAVICON_PATH')) }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/css/uikit.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link href="https://cdn.datatables.net/v/bs4/dt-2.3.5/r-3.0.7/datatables.min.css" rel="stylesheet"
        integrity="sha384-7BuMUZVY1n5/MC0a4MwlfSWYITJAWwNfOI3Pn3G37vlXjjKMqKowKM15z2TY/7Nt" crossorigin="anonymous">

    @stack('css')
    <style>
        .img-fixed {
            /* lebar konsisten */
            width: 200px;
            /* tinggi konsisten */
            height: 200px;
            /* isi kotak tanpa lonjong */
            object-fit: cover;
            /* Kalau kamu ingin seluruh gambar terlihat utuh (tidak ada bagian terpotong) */
            /* object-fit: contain;  */
            /* fokus di tengah */
            object-position: center;
            /* opsional, isi ruang kosong */
            /* background-color: #f0f0f0; */
        }

        /* Pastikan lightbox selalu di atas navbar & sidebar */
        .uk-lightbox,
        .uk-lightbox-overlay {
            z-index: 99999 !important;
        }

        /* Pastikan modal bansos selalu di depan detail warga */
        #bansosModal {
            z-index: 99998 !important;
        }

        #bansosModal+.modal-backdrop {
            z-index: 99997 !important;
        }

        /* Pastikan modal detail warga selalu paling depan */
        #modalDetailWarga {
            z-index: 99996 !important;
        }

        #modalDetailWarga+.modal-backdrop {
            z-index: 99995 !important;
        }

        span.select2-results,
        span.select2-selection {
            text-transform: capitalize !important;
        }
    </style>
</head>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        @auth
            @include('layouts.navbar')
        @endauth


        @auth
            @include('layouts.sidebar')
        @endauth


        <div class="content-wrapper">


            <section class="content-header">
                <div class="container-fluid">
                    <h1 class="mb-2">@yield('page-title')</h1>
                </div>
            </section>


            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>

        </div>


        @auth
            @include('layouts.footer')
        @endauth

    </div>


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.25.4/dist/js/uikit-icons.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('adminlte/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.defaultDataTable').DataTable({
                columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center'
                }],
                // "responsive": true,
            });
            $('#usersTable').DataTable();
            $(".reportsTable").DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                rowGroup: {
                    dataSrc: 1 // index kolom No KK
                }
            })

            //Initialize Select2 Elements
            $('.select2').select2({
                minimumResultsForSearch: -1
            })

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });

        // Fungsi format tanggal dd-mm-yyyy
        function formatDateInKk(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }
    </script>

    <script>
        $(document).on('click', '.btnShowKK', function() {
            const id = $(this).data('id');
            const url = "{{ route('kk.show', ':id') }}".replace(':id', id);

            // Pastikan modal tidak bisa ditutup oleh backdrop atau ESC
            // $('#modalDetailKK').attr('data-backdrop', 'static').attr('data-keyboard', 'false');
            $('#modalDetailKK').modal('show');

            $('#keluargaBody').html(`
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Memuat data...
                        </td>
                    </tr>
                `);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // Header KK
                    $('#showNoKk').text(res.kartu_keluarga.no_kk ?? '-');
                    $('#showNamaKepalaKeluarga').text(res.kartu_keluarga.nama_kepala_keluarga ?? '-');
                    $('#showAlamat').text(res.kartu_keluarga.alamat ?? '-');
                    $('#showRt').text(res.kartu_keluarga.rt ?? '-');
                    $('#showRw').text(res.kartu_keluarga.rw ?? '-');
                    $('#showDesaKelurahan').text(res.kartu_keluarga.desa ?? '-');
                    $('#showKecamatan').text(res.kartu_keluarga.kecamatan ?? '-');
                    $('#showKabupatenKota').text(res.kartu_keluarga.kabupaten ?? '-');
                    $('#showKodePos').text(res.kartu_keluarga.kode_pos ?? '-');
                    $('#showProvinsi').text(res.kartu_keluarga.provinsi ?? '-');

                    if (!res.status || res.warga.length === 0) {
                        $('#keluargaBody').html(`
                                <tr>
                                    <td colspan="9" class="text-center text-danger">
                                        Data keluarga masih kosong
                                    </td>
                                </tr>
                            `);
                    } else {
                        let html = '';
                        let no = 1;

                        res.warga.forEach(item => {
                            html += `
                                <tr>
                                    <td>${no++}</td>
                                    <td>
                                        ${item.nama} <a href="javascript:;" class="detailWarga" data-warga-id="${item.id}"><i class="far fa-eye"></i></a>
                                        <div class="d-table-cell">
                                            <span class="badge badge-dark text-muted text-white text-xs">${item.status_perkawinan}</span>
                                            <span class="badge badge-info text-muted text-white text-xs">${item.status_hubungan}</span>
                                        </div>
                                    </td>
                                    <td>${item.nik}</td>
                                    <td>${item.jenis_kelamin}</td>
                                    <td>${item.tempat_lahir}</td>
                                    <td>${formatDateInKk(item.tanggal_lahir)}</td>
                                    <td>${item.agama}</td>
                                    <td>${item.pendidikan}</td>
                                    <td>${item.pekerjaan?.nama ?? '-'}</td>
                                </tr>
                            `;
                        });

                        $('#keluargaBody').html(html);
                    }

                    // Map Koordinat
                    const lat = res.kartu_keluarga.latitude;
                    const lng = res.kartu_keluarga.longitude;

                    if (lat && lng) {
                        $('#showLat').text(lat);
                        $('#showLng').text(lng);

                        setTimeout(() => {
                            initMap(lat, lng);
                        }, 300); // delay agar modal sudah tampil
                    } else {
                        $('#showLat').text('-');
                        $('#showLng').text('-');

                        $('#map').html(`
                            <div class="text-center text-muted mt-5">
                                Koordinat belum tersedia
                            </div>
                        `);
                    }

                    // Media
                    let mediaHtml = '';

                    if (res.media && res.media.length > 0) {
                        mediaHtml += ' <div class="row" uk-lightbox="slidenav: false; nav: thumbnav">';

                        res.media.forEach(media => {
                            mediaHtml += `
                                <div class="col-3">
                                    <a href="/storage/${media.file_path}" data-caption="${media.keterangan}">
                                        <img src="/storage/${media.file_path}" class="img-fluid rounded border img-fixed" width="150" height="150">
                                    </a>
                                </div>
                            `;
                        });

                        mediaHtml += '</ div>';
                    } else {
                        mediaHtml = `
                            <div class="col-12 text-muted text-center">
                                Tidak ada media rumah
                            </div>
                        `;
                    }

                    $('#mediaContainer').html(mediaHtml);
                },
                error: function(xhr) {
                    // let response = xhr.responseJSON;
                    // console.log(response.data);
                    $('#keluargaBody').html(`
                        <tr>
                            <td colspan="9" class="text-center text-danger">
                                Gagal memuat data kartu keluarga
                            </td>
                        </tr>
                    `);
                }
            });
        });

        // Show Detail Warga
        $(document).on('click', '.detailWarga', function() {
            const id = $(this).data('warga-id');
            const url = "{{ route('warga.show', ':id') }}".replace(':id', +id);

            $('#modalDetailWarga').modal('show');

            // kosongkan #indikatorBody
            $('#detailWargaIndikatorBody').empty();
            $('#detailWargaPenerimaBansosBody').empty();
            // $('#detailWargaIndikatorBody').html('');
            // $('#detailWargaPenerimaBansosBody').html('');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // Informasi Warga
                    $('#detailWargaNoKK').text(res.warga.no_kk ?? '-');
                    $('#detailWargaNIK').text(res.warga.nik ?? '-');
                    $('#detailWargaNama').text(res.warga.nama ?? '-');
                    $('#detailWargaJenisKelamin').text(res.warga.jenis_kelamin ?? '-');
                    $('#detailWargaTempatLahir').text(res.warga.tempat_lahir ?? '-');
                    $('#detailWargaTanggalLahir').text(res.warga.tanggal_lahir ? formatDateInKk(res
                        .warga.tanggal_lahir) : '-');
                    let jenisKelamin = res.warga.jenis_kelamin === 'L' ? 'Laki-Laki' : (res.warga
                        .jenis_kelamin === 'P' ? 'Perempuan' : '-');
                    $('#detailWargaJenisKelamin').text(jenisKelamin);
                    $('#detailWargaAgama').text(res.warga.agama ?? '-');
                    $('#detailWargaPendidikan').text(res.warga.pendidikan ?? '-');
                    $('#detailWargaPekerjaan').text(res.warga.pekerjaan?.nama ?? '-');
                    $('#detailWargaStatusHubungan').text(res.warga.status_hubungan ?? '-');
                    $('#detailWargaStatusPerkawinan').text(res.warga.status_perkawinan ?? '-');
                    $('#detailWargaStatusWarga').text(res.warga.status_warga ?? '-');
                    $('#detailWargaAlamat').text(res.kartu_keluarga.alamat ?? '-');
                    $('#detailWargaRTRW').text(res.kartu_keluarga.rt ?? '-');
                    // isi value warga_id di tombol tambah bansos & isi value hidden input di modal bansos
                    $('#modalDetailWarga .btnAddBansos').data('warga-id', res.warga.id);
                    // Indikator Kesejahteraan Masyarakat
                    if (res.kategori.length === 0) {
                        $('#detailWargaIndikatorBody').html(
                            `<tr>
                                <td colspan="2" class="text-center text-muted">
                                    Tidak ada data indikator
                                </td>
                            </tr>`
                        );
                    } else {
                        let indikatorHtml = '';
                        const grouped = {};

                        // Group indikator by tipe
                        res.kategori.forEach(item => {
                            if (!grouped[item.tipe]) {
                                grouped[item.tipe] = [];
                            }
                            grouped[item.tipe].push(item);
                        });

                        // Build HTML
                        for (const tipe in grouped) {
                            indikatorHtml += `
                                <tr class="bg-light">
                                    <td colspan="2">
                                        <strong>${tipe.charAt(0).toUpperCase() + tipe.slice(1)}</strong>
                                    </td>
                                </tr>
                            `;
                            grouped[tipe].forEach(kat => {
                                indikatorHtml += `
                                    <tr>
                                        <td style="padding-left:20px">
                                            <b>*</b> ${kat.nama}
                                        </td>
                                        <td class="text-capitalize">
                                            ${kat.pivot.nilai ?? ':-'}
                                        </td>
                                    </tr>
                                `;
                            });
                        }

                        $('#detailWargaIndikatorBody').html(indikatorHtml);
                    }
                    // Penerima Bansos
                    let bansosHtml = '';
                    if (res.warga.bansos.length === 0) {
                        bansosHtml = `
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    Tidak ada data penerima bansos
                                </td>
                            </tr>
                        `;
                    } else {
                        res.warga.bansos.forEach(bansos => {
                            bansosHtml += `
                                <tr>
                                    <td>${bansos.nama_program}</td>
                                    <td>${bansos.tahun}</td>
                                    <td>
                                        ${bansos.pivot.keterangan ?? '-'}
                                        <br>
                                        <small class="text-muted">
                                            ${bansos.pivot.status} • ${bansos.pivot.tanggal_penerimaan}
                                        </small>
                                    </td>
                                </tr>
                            `;
                        });
                    }
                    $('#detailWargaPenerimaBansosBody').html(bansosHtml);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON
                    console.log(response);
                }
            })
        })
        // Jika Tombol Tambah Bansos dalam .detailWarga di klik maka Tangani dibawah ini
        $(document).on('click', '.btnAddBansos', function() {
            const wargaId = $(this).data('warga-id');
            $('#bansosModal').modal('show');
            $('#bansosModal #warga_id').val(wargaId);
        });

        let map;
        let marker;

        function initMap(lat, lng) {
            if (!map) {
                map = L.map('map').setView([lat, lng], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);
            }

            if (marker) {
                marker.remove();
            }

            marker = L.marker([lat, lng]).addTo(map);

            marker.on('mouseover', function() {
                this._icon.style.cursor = 'pointer';
            });
            marker.bindTooltip('Klik untuk buka aplikasi map');
            // CLICK MARKER → GOOGLE MAPS
            // marker.on('click', function() {
            //     openGoogleMaps(lat, lng);
            // });
            marker.bindPopup(`
                <div class="text-center">
                    <strong>Lokasi Rumah</strong><br>
                    <button class="btn btn-sm btn-primary mt-2"
                        onclick="openGoogleMaps(${lat}, ${lng})">
                        Buka Aplikasi Map
                    </button>
                    <button class="btn btn-sm btn-info mt-2"
                        onclick="openNavGoogleMaps(${lat}, ${lng})">
                        Arahkan ke Lokasi
                    </button>
                </div>
            `);

            map.setView([lat, lng], 16);
        }

        function openGoogleMaps(lat, lng) {
            if (!lat || !lng) {
                alert('Koordinat tidak valid');
                return;
            }

            const url = `https://www.google.com/maps?q=${lat},${lng}`;
            window.open(url, '_blank');
        }

        function openNavGoogleMaps(lat, lng) {
            const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
            window.open(url, '_blank');
        }
    </script>

    @stack('js')
</body>

</html>
