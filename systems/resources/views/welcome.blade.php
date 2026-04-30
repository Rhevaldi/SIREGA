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
        body {
            background: #f1f5f9;
        }

        .hero {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            color: white;
            padding: 60px 0;
        }

        .hero h1 {
            font-weight: 800;
            font-size: 40px;
        }

        .small-box {
            border-radius: 12px;
            transition: 0.2s;
        }

        .small-box:hover {
            transform: translateY(-5px);
        }

        .card {
            border-radius: 12px;
            border: none;
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #eee;
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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
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
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="d-none d-md-inline">Dashboard</span>
                        </a>
                    </li>
                    @endrole

                    @role('superadmin')
                    <li class="nav-item mr-2">
                        <span class="badge badge-danger">SUPER ADMIN</span>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="d-none d-md-inline">Dashboard</span>
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

                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold">📊 Statistik Umum Warga</h3>
                        <p class="text-muted">Ringkasan data kependudukan</p>
                    </div>

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
                    <div class="row mt-4">

                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm">
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
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <strong><i class="fas fa-chart-pie mr-2 text-success"></i>Statistik KK</strong>
                                </div>
                                <div class="card-body" style="height:300px;">
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
            type: 'pie',
            data: {
                labels: ['KK', 'Warga'],
                datasets: [{
                    data: [{{ $totalKK }}, {{ $totalWarga }}],
                    backgroundColor: ['#20c997', '#6610f2']
                }]
            }
        });

        var map = L.map('map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var wargaMarkers = {!! json_encode($wargas) !!};
        var group = L.featureGroup();

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