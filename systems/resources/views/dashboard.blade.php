@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalKK }}</h3>
                    <p>Kepala Keluarga</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalWarga }}</h3>
                    <p>Total Warga</p>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <h3>{{ $totalLakiLaki }}</h3>
                    <p>Jumlah Laki-Laki</p>
                </div>
                <div class="icon"><i class="fas fa-male"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalPerempuan }}</h3>
                    <p>Jumlah Perempuan</p>
                </div>
                <div class="icon"><i class="fas fa-female"></i></div>
            </div>
        </div>

    </div>

    <div class="row mt-3">

        <div class="col-md-6 mb-3">
            <div class="card card-primary h-100">
                <div class="card-header d-flex align-items-center">
                    <h3 class="card-title mb-0">
                        Statistik Penerima Bantuan ({{ $tahunAktif }})
                    </h3>
                    <form method="GET" class="ml-auto m-0 p-0" style="width: auto;">
                        <select name="tahun" class="form-control form-control-sm" style="min-width: 100px;"
                            onchange="this.form.submit()">
                            @foreach ($listTahun as $t)
                                <option value="{{ $t }}" {{ $tahunAktif == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <div class="card-body" style="height: 300px;">
                    <canvas id="bansosBarChart" style="height: 100%; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card card-info h-100">
                <div class="card-header">
                    <h3 class="card-title">Statistik by Jenis Kelamin</h3>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="genusChart" style="height: 100%; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>



    <div class="col-12 mt-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Lokasi Warga</h3>
            </div>
            <div class="card-body">
                <div id="mapDashboard" style="height:500px"></div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modals -->
    @include('kk.show')
    @include('warga.show')


@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===============================
            // BAR CHART PENERIMA BANTUAN (Calon & Penerima)
            // ===============================
            const bansosStatsRaw = @json($bansosStats);

            if (bansosStatsRaw.length > 0) {
                // Group by program name
                const groupedByProgram = {};
                bansosStatsRaw.forEach(item => {
                    if (!groupedByProgram[item.nama_program]) {
                        groupedByProgram[item.nama_program] = {
                            'calon penerima': 0,
                            'penerima': 0
                        };
                    }
                    groupedByProgram[item.nama_program][item.status] = item.jumlah_penerima;
                });

                const programNames = Object.keys(groupedByProgram);
                const calonPenerimaData = programNames.map(prog => groupedByProgram[prog]['calon penerima']);
                const penerimaBenusData = programNames.map(prog => groupedByProgram[prog]['penerima']);

                new Chart(document.getElementById('bansosBarChart'), {
                    type: 'bar',
                    data: {
                        labels: programNames,
                        datasets: [{
                                label: 'Calon Penerima',
                                data: calonPenerimaData,
                                backgroundColor: '#ffc107',
                                borderColor: '#ff9800',
                                borderWidth: 1
                            },
                            {
                                label: 'Penerima',
                                data: penerimaBenusData,
                                backgroundColor: '#28a745',
                                borderColor: '#1e7e34',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        indexAxis: 'y',
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(ctx) {
                                        return ctx.dataset.label + ': ' + ctx.parsed.x + ' orang';
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            }

            // ===============================
            // PIE CHART WARGA BY JENIS KELAMIN
            // ===============================
            const genusLabels = @json($wargaByJenisKelamin->keys());
            const genusData = @json($wargaByJenisKelamin->values());

            new Chart(document.getElementById('genusChart'), {
                type: 'doughnut',
                data: {
                    labels: genusLabels,
                    datasets: [{
                        data: genusData,
                        backgroundColor: ['#0d6efd', '#d61f69'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(ctx) {
                                    return ctx.label + ': ' + ctx.parsed + ' orang';
                                }
                            }
                        }
                    }
                }
            });

            // ===============================
            // MAP WARGA
            // ===============================
            var mapDashboard = L.map('mapDashboard', {
                scrollWheelZoom: false
            });
            mapDashboard.on('focus', () => {
                mapDashboard.scrollWheelZoom.enable();
            });
            mapDashboard.on('blur', () => {
                mapDashboard.scrollWheelZoom.disable();
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap',
            }).addTo(mapDashboard);

            var defaultIcon = L.icon({
                iconUrl: `{{ asset('adminlte/img/map-default-icon.png') }}`,
                iconSize: [24, 24],
                iconAnchor: [16, 32],
                popupAnchor: [1, -34],
            });

            var bansosIcon = L.icon({
                iconUrl: `{{ asset('adminlte/img/map-bansos-penerima-icon.png') }}`,
                iconSize: [24, 24],
                iconAnchor: [16, 32],
                popupAnchor: [0, -28]
            });

            var wargaMarkers = {!! json_encode($wargas) !!};
            var markerGroup = L.featureGroup();

            console.log(wargaMarkers);

            wargaMarkers.forEach(function(warga) {
                if (!warga.latitude || !warga.longitude) return;

                // FLAG dari backend
                var hasBansosTahunBerjalan = warga.has_bansos_tahun_berjalan === true;

                // Tentukan icon
                var iconToUse = hasBansosTahunBerjalan ? bansosIcon : defaultIcon;

                // Marker
                var marker = L.marker(
                    [parseFloat(warga.latitude), parseFloat(warga.longitude)], {
                        icon: iconToUse
                    }
                );

                // Klik marker → modal
                marker.on('click', function() {
                    showKkModal(warga.id);
                });

                markerGroup.addLayer(marker);
            });

            markerGroup.addTo(mapDashboard);

            if (markerGroup.getLayers().length > 0) {
                mapDashboard.fitBounds(markerGroup.getBounds(), {
                    padding: [30, 30]
                });
            } else {
                mapDashboard.setView([0, 0], 5);
            }

        });

        function showKkModal(id) {
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
        }

        if (window.UIkit) {
            UIkit.lightbox('[uk-lightbox]');
        }
    </script>
@endpush
