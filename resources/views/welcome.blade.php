<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIREGA - Dashboard Publik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- AdminLTE --}}
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">

    <style>
        .hero {
            background: linear-gradient(120deg, #007bff, #00c6ff);
            color: white;
            padding: 50px 0;
        }
        .hero h1 {
            font-weight: bold;
        }
        .small-box {
            border-radius: 10px;
        }
        footer {
            background: #f4f6f9;
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

    {{-- NAVBAR --}}
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

    {{-- HERO HEADER --}}
    <section class="hero text-center">
        <div class="container">
            <h1>SIREGA</h1>
            <p class="lead mb-0">Sistem Informasi RT & Warga Desa</p>
            <small>Dashboard Publik Transparansi Data</small>
        </div>
    </section>

    {{-- CONTENT --}}
    <div class="content-wrapper">
        <div class="content pt-4">
    <div class="container-fluid px-4">


                {{-- SECTION TITLE --}}
                <div class="text-center mb-4">
                    <h3 class="font-weight-bold">📊 Statistik Umum Desa</h3>
                    <p class="text-muted">Ringkasan data kependudukan dan bantuan sosial</p>
                </div>

                {{-- STAT BOX --}}
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

                {{-- CHART --}}
                <div class="row mt-4">
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-primary text-white d-flex align-items-center">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-chart-pie mr-1"></i> Statistik Bantuan ({{ $tahunAktif }})
                                </h3>
                                <form method="GET" class="ml-auto">
                                    <select name="tahun" class="form-control form-control-sm"
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
                                <canvas id="bansosChart"></canvas>
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

                {{-- MAP --}}
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

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <strong>SIREGA</strong> &copy; {{ date('Y') }}  
            <br>
            <small>Data bersifat publik dan non-sensitif</small>
        </div>
    </footer>

</div>

{{-- JS --}}
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // BANSOS CHART
    const labels = @json($statistik->pluck('nama_program'));
    const dataWarga = @json($statistik->pluck('jumlah_warga'));

    if (labels.length > 0) {
        new Chart(document.getElementById('bansosChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataWarga,
                    backgroundColor: ['#007bff','#28a745','#17a2b8','#ffc107','#dc3545']
                }]
            },
            options: { maintainAspectRatio: false }
        });
    }

    // KK CHART
    new Chart(document.getElementById('kkChart'), {
        type: 'pie',
        data: {
            labels: ['Total KK', 'Total Warga'],
            datasets: [{
                data: [{{ $totalKK }}, {{ $totalWarga }}],
                backgroundColor: ['#20c997', '#6610f2']
            }]
        },
        options: { maintainAspectRatio: false }
    });

    // MAP
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
        map.fitBounds(markerGroup.getBounds(), { padding: [30, 30] });
    } else {
        map.setView([0,0], 5);
    }
});
</script>

</body>
</html>
