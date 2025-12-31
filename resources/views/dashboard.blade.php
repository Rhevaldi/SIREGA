@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalWarga }}</h3>
                    <p>Total Warga</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $statusWarga['wargaAktif'] }}</h3>
                    <p>Warga Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <h3>{{ $statusWarga['wargaPindah'] }}</h3>
                    <p>Warga Pindah</p>
                </div>
                <div class="icon"><i class="fas fa-people-carry"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $statusWarga['wargaMeninggal'] }}</h3>
                    <p>Warga Meninggal</p>
                </div>
                <div class="icon"><i class="fas fa-user-times"></i></div>
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
                    <canvas id="bansosChart" style="height: 100%; width: 100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card card-info h-100">
                <div class="card-header">
                    <h3 class="card-title">Statistik Kartu Keluarga Warga</h3>
                </div>
                <div class="card-body" style="height: 300px;">
                    <canvas id="kkChart" style="height: 100%; width: 100%;"></canvas>
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
                <div id="map" style="height:500px"></div>
            </div>
        </div>
    </div>
    </div>

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
            // PIE CHART BANSOS
            // ===============================
            const labels = @json($statistik->pluck('nama_program'));
            const dataWarga = @json($statistik->pluck('jumlah_warga'));

            if (labels.length > 0) {
                new Chart(document.getElementById('bansosChart'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: dataWarga,
                            backgroundColor: [
                                '#4e73df', '#1cc88a', '#36b9cc',
                                '#f6c23e', '#e74a3b', '#858796'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(ctx) {
                                        return ctx.label + ' : ' + ctx.parsed + ' warga';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // ===============================
            // PIE CHART KK 
            // ===============================
            const kkData = {
                labels: ['Total KK', 'Total Warga'],
                datasets: [{
                    data: [{{ $totalKK }}, {{ $totalWarga }}],
                    backgroundColor: ['#0d6efd', '#20c997']
                }]
            };

            new Chart(document.getElementById('kkChart'), {
                type: 'pie',
                data: kkData,
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // ===============================
            // MAP WARGA
            // ===============================
            var map = L.map('map');

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var defaultIcon = L.icon({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                shadowSize: [41, 41]
            });

            var bansosIcon = L.icon({
                iconUrl: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -28]
            });

            var wargaMarkers = {!! json_encode($wargas) !!};
            var markerGroup = L.featureGroup();

            wargaMarkers.forEach(function(warga) {
                if (!warga.latitude || !warga.longitude) return;

                var hasBansos = warga.bansos.length > 0;
                var iconToUse = hasBansos ? bansosIcon : defaultIcon;

                var bansosHtml = '';
                if (hasBansos) {
                    bansosHtml += '<hr><strong>Daftar Bansos Tahun Ini:</strong><ul>';
                    warga.bansos.forEach(function(b) {
                        bansosHtml += `<li>${b.nama} <small>(${b.tanggal})</small></li>`;
                    });
                    bansosHtml += '</ul>';
                }

                var popupContent = `
                    <strong>${warga.nama}</strong><br>
                    ${warga.alamat}
                    ${bansosHtml}
                `;

                var marker = L.marker(
                    [parseFloat(warga.latitude), parseFloat(warga.longitude)], {
                        icon: iconToUse
                    }
                ).bindPopup(popupContent);

                markerGroup.addLayer(marker);
            });

            markerGroup.addTo(map);

            if (markerGroup.getLayers().length > 0) {
                map.fitBounds(markerGroup.getBounds(), {
                    padding: [30, 30]
                });
            } else {
                map.setView([0, 0], 5);
            }
        });
    </script>
@endpush
