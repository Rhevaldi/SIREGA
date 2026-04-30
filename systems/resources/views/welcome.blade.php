<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIREGA - Dashboard Publik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: white;
            padding: 10px 0;

        }

        .hero h1 {
            font-weight: 800;
            font-size: 28px;
        }

        .hero p {
            font-weight: 300;
        }

        .hero small {
            opacity: 0.9;
        }

        #map {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }



        .small-box {
            border-radius: 12px;
            transition: 0.2s;
            position: relative;
            overflow: hidden;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .small-box::after {
            content: '';
            position: absolute;
            width: 120%;
            height: 120%;
            background: rgba(255, 255, 255, 0.1);
            top: -50%;
            left: -50%;
            transform: rotate(25deg);
        }

        .card {
            border-radius: 16px;
            transition: all 0.25s ease;
            border: none;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .content-wrapper {
            padding-bottom: 30px;
        }

        .navbar {
            backdrop-filter: blur(10px);
        }

        .info-box {
            border-radius: 10px;
        }

        footer {
            background: #fff;
            padding: 15px 0;
            text-align: center;
            font-size: 13px;
            border-top: 1px solid #ddd;
        }

        .bg-pink {
            background: #ec4899 !important;
        }
    </style>

</head>

<body class="layout-top-nav">
    <div class="wrapper">

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid px-4">
                <a href="/" class="navbar-brand font-weight-bold text-primary">
                    <i class="fas fa-landmark mr-1"></i> SIREGA
                </a>

                <ul class="navbar-nav ml-auto align-items-center">
                    @auth
                        @role('admin')
                            <li class="nav-item mr-2">
                                <span class="badge badge-danger">ADMIN</span>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a>
                            </li>
                        @endrole

                        @role('warga')
                            <li class="nav-item mr-2">
                                <span class="badge badge-info">WARGA</span>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('warga.area') }}" class="nav-link">
                                    <i class="fas fa-id-card"></i> Dashboard
                                </a>
                            </li>
                        @endrole
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- HERO -->
        <section class="hero text-center">
            <div class="container">
                <h1>SIREGA</h1>
                <p class="lead">SIREGA - Sistem Informasi Registrasi & Geolokasi Warga</p>
                <small>Dashboard Publik Transparansi Data</small>
            </div>
        </section>

        <!-- CONTENT -->
        <div class="content-wrapper">
            <div class="content pt-5 pb-4">
                <div class="container-fluid px-4">


                    <!-- STAT -->
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

                    <!-- CARD -->
                    <div class="row mt-4 align-items-stretch">

                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-header">
                                    <strong><i class="fas fa-venus-mars mr-2 text-primary"></i>Jenis Kelamin</strong>
                                </div>
                                <div class="card-body">

                                    <div class="info-box mb-2">
                                        <span class="info-box-icon bg-primary"><i class="fas fa-male"></i></span>
                                        <div class="info-box-content">
                                            <span>Laki-laki</span>
                                            <strong>{{ $jenisKelamin['laki'] }}</strong>
                                        </div>
                                    </div>

                                    <div class="info-box">
                                        <span class="info-box-icon bg-pink"><i class="fas fa-female"></i></span>
                                        <div class="info-box-content">
                                            <span>Perempuan</span>
                                            <strong>{{ $jenisKelamin['perempuan'] }}</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm h-100">
                                <div class="card-header">
                                    <strong><i class="fas fa-chart-pie mr-2 text-success"></i>Statistik Kartu
                                        Keluarga</strong>
                                </div>
                                <div class="card-body" style="height:224px;">
                                    <canvas id="kkChart"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- MAP -->
                    <div class="card shadow-sm mt-4">
                        <div class="card-header">
                            <strong><i class="fas fa-map-marker-alt text-danger mr-2"></i>Peta Warga</strong>
                        </div>
                        <div class="card-body">
                            <div id="map" style="height:500px;border-radius:10px;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer>
            <strong>SIREGA</strong> © {{ date('Y') }}
        </footer>

    </div>

    <!-- SCRIPT -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        new Chart(document.getElementById('kkChart'), {
            type: 'doughnut',
            data: {
                labels: ['KK', 'Warga'],
                datasets: [{
                    data: [{{ $totalKK }}, {{ $totalWarga }}],
                    backgroundColor: ['#20c997', '#6610f2'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });



        var map = L.map('map', {
            zoomControl: false
        });

        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var wargaMarkers = {!! json_encode($wargas) !!};
        var group = L.featureGroup();
        zoomControl: false
        wargaMarkers.forEach(w => {
            if (!w.latitude || !w.longitude) return;

            let marker = L.marker([w.latitude, w.longitude])
                .bindPopup(`<b>${w.nama}</b><br>${w.alamat}`);

            group.addLayer(marker);
        });

        group.addTo(map);

        if (group.getLayers().length > 0) {
            map.fitBounds(group.getBounds());
        } else {
            map.setView([0, 0], 5);
        }
    </script>

</body>

</html>
