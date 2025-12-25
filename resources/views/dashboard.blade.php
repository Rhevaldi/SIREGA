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
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $statusWarga['wargaAktif'] }}</h3>
                    <p>Warga Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <h3>{{ $statusWarga['wargaPindah'] }}</h3>
                    <p>Warga Pindah</p>
                </div>
                <div class="icon">
                    <i class="fas fa-people-carry"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $statusWarga['wargaMeninggal'] }}</h3>
                    <p>Warga Meninggal</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-times"></i>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Statistik Penerima Bantuan</h3>
                </div>
                <div class="card-body">
                    {{-- <canvas id="kategoriChart" height="120"></canvas> --}}
                    <div style="position: relative; height: 400px; width: 100%;">
                        <canvas id="kategoriChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card bg-gradient-success">
                <div class="card-header border-0">
                    <h3 class="card-title">
                        <i class="far fa-calendar-alt"></i>
                        Calendar
                    </h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"
                                data-offset="-52">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a href="#" class="dropdown-item">Add new event</a>
                                <a href="#" class="dropdown-item">Clear events</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">View calendar</a>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="calendar" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lokasi Warga</h3>
                </div>
                <div class="card-body">
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/auto"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. Siapkan Data (Gunakan direktif json agar lebih bersih dari json_encode)
            // const labels = @json($statistik->pluck('nama'));
            // const counts = @json($statistik->pluck('total'));
            // // 2. Definisi Palette Warna (Warna-warna modern)
            // const chartColors = [
            //     'rgba(255, 99, 132, 0.7)', // Merah
            //     'rgba(54, 162, 235, 0.7)', // Biru
            //     'rgba(255, 206, 86, 0.7)', // Kuning
            //     'rgba(75, 192, 192, 0.7)', // Teal
            //     'rgba(153, 102, 255, 0.7)', // Ungu
            //     'rgba(255, 159, 64, 0.7)', // Oranye
            //     'rgba(199, 199, 199, 0.7)', // Abu-abu
            //     'rgba(83, 221, 108, 0.7)' // Hijau
            // ];
            // // Border warna yang lebih pekat
            // const borderColors = chartColors.map(color => color.replace('0.7', '1'));
            // // 3. Konfigurasi Chart
            // const config = {
            //     type: 'bar',
            //     data: {
            //         labels: labels,
            //         datasets: [{
            //             label: 'Jumlah Warga',
            //             data: counts,
            //             backgroundColor: chartColors, // Otomatis mengulang jika data > warna
            //             borderColor: borderColors,
            //             borderWidth: 1.5,
            //             borderRadius: 5, // Membuat bar sedikit tumpul (lebih modern)
            //         }]
            //     },
            //     options: {
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         plugins: {
            //             legend: {
            //                 display: false // Sembunyikan legend jika hanya satu dataset
            //             }
            //         },
            //         scales: {
            //             y: {
            //                 beginAtZero: true,
            //                 grid: {
            //                     display: true,
            //                     drawBorder: false
            //                 },
            //                 ticks: {
            //                     precision: 0
            //                 }
            //             },
            //             x: {
            //                 grid: {
            //                     display: false
            //                 }
            //             }
            //         }
            //     }
            // };
            // // 4. Render Chart
            // const ctx = document.getElementById('kategoriChart').getContext('2d');
            // new Chart(ctx, config);

            // --- BAGIAN DATA (SAMA SEPERTI SEBELUMNYA) ---
            const labels = @json($statistik->pluck('nama_program'));
            const counts = @json($statistik->pluck('total'));

            const chartColors = [
                'rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)', 'rgba(255, 159, 64, 0.7)',
                'rgba(199, 199, 199, 0.7)', 'rgba(83, 221, 108, 0.7)'
            ];
            const borderColors = chartColors.map(color => color.replace('0.7', '1'));


            // --- BAGIAN KONFIGURASI CHART (YANG DIPERBAIKI) ---
            const config = {
                type: 'bar', // Tetap 'bar'
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Penerima',
                        data: counts,
                        backgroundColor: chartColors,
                        borderColor: borderColors,
                        borderWidth: 1.5,
                        borderRadius: 6, // Ujung bar lebih melengkung
                        barPercentage: 0.6, // Mengatur ketebalan bar (0.1 - 1.0). Semakin kecil semakin tipis.
                        categoryPercentage: 0.8 // Mengatur jarak antar kategori
                    }]
                },
                options: {
                    // --- KUNCI UTAMA: Mengubah orientasi menjadi Horizontal ---
                    indexAxis: 'y',

                    responsive: true,
                    // Penting: set ke false agar tinggi mengikuti container HTML (div pembungkus)
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah penerima: ' + context.parsed.x + ' warga';
                                }
                            }
                        }
                    },
                    scales: {
                        // Sumbu X (sekarang menjadi penunjuk jumlah angka di bawah)
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false // Hilangkan garis vertikal agar bersih
                            },
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        // Sumbu Y (sekarang berisi Label Kategori di kiri)
                        y: {
                            grid: {
                                // Garis horizontal tipis untuk memandu mata
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    size: 14, // Perbesar font label kategori agar jelas
                                    weight: '500'
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            right: 20 // Memberi sedikit ruang di kanan agar angka tidak terpotong
                        }
                    }
                }
            };

            const ctx = document.getElementById('kategoriChart').getContext('2d');
            new Chart(ctx, config);


            $('#calendar').datetimepicker({
                format: 'L',
                inline: true
            });


            var map = L.map('map').setView([0, 0], 13);


            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);


            var wargaMarkers = {!! json_encode($wargas) !!};
            wargaMarkers.forEach(function(warga) {
                if (warga.latitude && warga.longitude) {
                    L.marker([warga.latitude, warga.longitude])
                        .addTo(map)
                        .bindPopup('<strong>' + warga.nama + '</strong><br>' + warga.alamat);
                }
            });


            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    map.setView([lat, lon], 15);
                    L.marker([lat, lon], {
                        icon: L.icon({
                            iconUrl: 'https://cdn-icons-png.flaticon.com/512/64/64113.png',
                            iconSize: [32, 32],
                            iconAnchor: [16, 32],
                        })
                    }).addTo(map).bindPopup('Ini lokasi kamu sekarang!').openPopup();
                }, function(error) {
                    alert('Gagal mendapatkan lokasi: ' + error.message);
                });
            } else {
                alert('Geolocation tidak didukung oleh browser ini.');
            }
        });
    </script>
@endpush
