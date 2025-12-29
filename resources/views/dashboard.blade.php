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
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        Statistik Penerima Bantuan ({{ $tahunAktif }})
                    </h3>
                    <form method="GET">
                        <select name="tahun" class="form-control form-control-sm" onchange="this.form.submit()">
                            @foreach ($listTahun as $t)
                                <option value="{{ $t }}" {{ $tahunAktif == $t ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <div style="height:220px">
                        <canvas id="bansosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
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

            // $('#calendar').datetimepicker({
            //     format: 'L',
            //     inline: true
            // });

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
                console.log(warga);

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
