<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIREGA - Dashboard Publik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <style>
        .hero {
            background: linear-gradient(120deg, #007bff, #00c6ff);
            color: white;
            padding: 5px 0;
        }

        .hero h1 {
            font-weight: bold;
        }

        .small-box {
            border-radius: 10px;
        }

        /* Hilangkan gap putih di atas footer */
        .content-wrapper,
        .content {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }

        .content-wrapper .card:last-child {
            margin-bottom: 0 !important;
        }

        footer {
            background: #f4f6f9;
            padding: 10px 0;
            margin-top: 0 !important;
            /* hilangkan jarak atas footer */
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #dee2e6;
        }

        /* Warna pink untuk gender */
        .bg-pink {
            background-color: #e83e8c !important;
            color: white !important;
        }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">


        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white shadow-sm">
            <div class="container-fluid px-4">
                <a href="/" class="navbar-brand font-weight-bold">
                    <i class="fas fa-landmark mr-1"></i> SIREGA
                </a>

                <ul class="navbar-nav ml-auto">
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="fas fa-tachometer-alt"></i> Dashboard Admin
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i> Login Admin
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>


        <section class="hero text-center">
            <div class="container">
                <h1>SIREGA</h1>
                <p class="lead mb-0">Sistem Informasi RT & Warga Desa</p>
                <small>Dashboard Publik Transparansi Data warga</small>
            </div>
        </section>


        <div class="content-wrapper">
            <div class="content pt-4">
                <div class="container-fluid px-4">



                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold">📊 Statistik Umum Warga</h3>
                        <p class="text-muted">Ringkasan data kependudukan</p>
                    </div>


                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info shadow">
                                <div class="inner">
                                    <h3>{{ $totalWarga }}</h3>
                                    <p>Total Warga</p>
                                </div>
                                <div class="icon"><i class="fas fa-users"></i></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success shadow">
                                <div class="inner">
                                    <h3>{{ $statusWarga['wargaAktif'] }}</h3>
                                    <p>Warga Aktif</p>
                                </div>
                                <div class="icon"><i class="fas fa-user-check"></i></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning shadow">
                                <div class="inner text-white">
                                    <h3>{{ $statusWarga['wargaPindah'] }}</h3>
                                    <p>Warga Pindah</p>
                                </div>
                                <div class="icon"><i class="fas fa-people-carry"></i></div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger shadow">
                                <div class="inner">
                                    <h3>{{ $statusWarga['wargaMeninggal'] }}</h3>
                                    <p>Warga Meninggal</p>
                                </div>
                                <div class="icon"><i class="fas fa-user-times"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">


                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-pink text-white">
                                    <h3 class="card-title mb-0">
                                        <i class="fas fa-venus-mars mr-1"></i> Komposisi Jenis Kelamin
                                    </h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="info-box shadow-sm">
                                                <span class="info-box-icon bg-primary"><i
                                                        class="fas fa-male"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Laki-laki</span>
                                                    <span class="info-box-number">{{ $jenisKelamin['laki'] }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="info-box shadow-sm">
                                                <span class="info-box-icon bg-pink"><i class="fas fa-female"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Perempuan</span>
                                                    <span
                                                        class="info-box-number">{{ $jenisKelamin['perempuan'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title mb-0">
                                        <i class="fas fa-chart-pie mr-1"></i> Statistik KK dan Warga
                                    </h3>
                                </div>
                                <div class="card-body" style="height: 300px;">
                                    <canvas id="kkChart"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>



                    <div class="col-12 mt-4 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-map-marker-alt mr-1"></i> Peta Sebaran Warga
                                </h3>
                            </div>
                            <div class="card-body">
                                <div id="map" style="height:500px;border-radius:8px"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer>
            <div class="container">
                <strong>SIREGA</strong> &copy; {{ date('Y') }}
                <br>
                <small>Data bersifat publik dan non-sensitif</small>
            </div>
        </footer>

    </div>


    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
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
                            backgroundColor: ['#007bff', '#28a745', '#17a2b8', '#ffc107', '#dc3545']
                        }]
                    },
                    options: {
                        maintainAspectRatio: false
                    }
                });
            }


            new Chart(document.getElementById('kkChart'), {
                type: 'pie',
                data: {
                    labels: ['Total KK', 'Total Warga'],
                    datasets: [{
                        data: [{{ $totalKK }}, {{ $totalWarga }}],
                        backgroundColor: ['#20c997', '#6610f2']
                    }]
                },
                options: {
                    maintainAspectRatio: false
                }
            });


            var map = L.map('map');
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            var wargaMarkers = {!! json_encode($wargas) !!};
            var markerGroup = L.featureGroup();

            wargaMarkers.forEach(function(warga) {
                if (!warga.latitude || !warga.longitude) return;

                var popupContent = `
            <strong>${warga.nama}</strong><br>
            ${warga.alamat}
        `;

                var marker = L.marker([parseFloat(warga.latitude), parseFloat(warga.longitude)])
                    .bindPopup(popupContent);

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

</body>

</html>
