<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page-title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?php echo e($totalWarga); ?></h3>
                    <p>Total Warga</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?php echo e($statusWarga['wargaAktif']); ?></h3>
                    <p>Warga Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-user-check"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner text-white">
                    <h3><?php echo e($statusWarga['wargaPindah']); ?></h3>
                    <p>Warga Pindah</p>
                </div>
                <div class="icon"><i class="fas fa-people-carry"></i></div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?php echo e($statusWarga['wargaMeninggal']); ?></h3>
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
                        Statistik Penerima Bantuan (<?php echo e($tahunAktif); ?>)
                    </h3>
                    <form method="GET" class="ml-auto m-0 p-0" style="width: auto;">
                        <select name="tahun" class="form-control form-control-sm" style="min-width: 100px;"
                            onchange="this.form.submit()">
                            <?php $__currentLoopData = $listTahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t); ?>" <?php echo e($tahunAktif == $t ? 'selected' : ''); ?>>
                                    <?php echo e($t); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    <!-- Modal Detail Warga from Marker -->
    <?php echo $__env->make('modal.dashboard-detail-warga', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===============================
            // PIE CHART BANSOS
            // ===============================
            const labels = <?php echo json_encode($statistik->pluck('nama_program'), 15, 512) ?>;
            const dataWarga = <?php echo json_encode($statistik->pluck('jumlah_warga'), 15, 512) ?>;

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
                    data: [<?php echo e($totalKK); ?>, <?php echo e($totalWarga); ?>],
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
            var map = L.map('map', {
                scrollWheelZoom: false
            });
            map.on('focus', () => {
                map.scrollWheelZoom.enable();
            });
            map.on('blur', () => {
                map.scrollWheelZoom.disable();
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap',
            }).addTo(map);

            var defaultIcon = L.icon({
                iconUrl: `<?php echo e(asset('adminlte/img/map-default-icon.png')); ?>`,
                iconSize: [24, 24],
                iconAnchor: [16, 32],
                popupAnchor: [1, -34],
            });

            var bansosIcon = L.icon({
                iconUrl: `<?php echo e(asset('adminlte/img/map-bansos-penerima-icon.png')); ?>`,
                iconSize: [24, 24],
                iconAnchor: [16, 32],
                popupAnchor: [0, -28]
            });

            var wargaMarkers = <?php echo json_encode($wargas); ?>;
            var markerGroup = L.featureGroup();

            console.log(wargaMarkers);


            // wargaMarkers.forEach(function(warga) {
            //     if (!warga.latitude || !warga.longitude) return;

            //     var hasBansosTahunBerjalan = warga.has_bansos_tahun_berjalan === true;
            //     var iconToUse = hasBansosTahunBerjalan ? bansosIcon : defaultIcon;

            //     var marker = L.marker(
            //         [parseFloat(warga.latitude), parseFloat(warga.longitude)], {
            //             icon: iconToUse
            //         }
            //     );

            //     marker.on('click', function() {
            //         showWargaModal(warga);
            //     });

            //     markerGroup.addLayer(marker);
            // });
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
                    showWargaModal(warga);
                });

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

        function showWargaModal(warga) {
            document.getElementById('md-no_kk').innerText = warga.no_kk;
            document.getElementById('md-nik').innerText = warga.nik;
            document.getElementById('md-nama').innerText = warga.nama;
            document.getElementById('md-jenis_kelamin').innerText = warga.jenis_kelamin;
            document.getElementById('md-tempat_lahir').innerText = warga.tempat_lahir;
            document.getElementById('md-tanggal_lahir').innerText = warga.tanggal_lahir;
            document.getElementById('md-agama').innerText = warga.agama;
            document.getElementById('md-pendidikan').innerText = warga.pendidikan;
            document.getElementById('md-pekerjaan').innerText = warga.pekerjaan;
            document.getElementById('md-status_hubungan').innerText = warga.status_hubungan;
            document.getElementById('md-status_perkawinan').innerText = warga.status_perkawinan;
            document.getElementById('md-status_warga').innerText = warga.status_warga;
            document.getElementById('md-alamat').innerText = warga.alamat;
            document.getElementById('md-rt').innerText = warga.rt?.rt ?? '-';

            let bansosHtml = '';

            if (warga.bansos_all && warga.bansos_all.length > 0) {
                warga.bansos_all.forEach(function(b) {
                    bansosHtml += `
                        <tr>
                            <td>${b.nama}</td>
                            <td class="text-center">${b.tahun}</td>
                            <td>
                                ${b.keterangan ?? '-'}
                                <br>
                                <small class="text-muted">
                                    ${b.status} • ${b.tanggal}
                                </small>
                            </td>
                        </tr>
                    `;
                });
            } else {
                bansosHtml = `
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            - Tidak Menerima Bantuan Sosial -
                        </td>
                    </tr>
                `;
            }

            document.getElementById('md-bansos').innerHTML = bansosHtml;

            // ===============================
            // MEDIA WARGA
            // ===============================
            let mediaHtml = '';

            if (warga.medias && warga.medias.length > 0) {
                mediaHtml += '<div class="row" uk-lightbox="slidenav: false; nav: thumbnav">';

                warga.medias.forEach(function(media) {
                    mediaHtml += `
                        <div class="col-md-3 text-center mb-3">
                            <a href="/storage/${media.file_path}"
                            data-caption="${media.keterangan ?? ''}">
                                <img src="/storage/${media.file_path}" width="200"
                                    class="img-fixed img-thumbnail mb-1"
                                    style="max-height: 200px;">
                            </a>
                            <div class="text-muted small">
                                ${media.keterangan ?? '-'}
                            </div>
                        </div>
                    `;
                });

                mediaHtml += '</div>';
            } else {
                mediaHtml = `
                    <div class="col-12 text-center text-muted">
                        - Tidak ada media warga -
                    </div>
                `;
            }

            document.getElementById('md-medias').innerHTML = mediaHtml;

            new bootstrap.Modal(
                document.getElementById('modalDetailWarga')
            ).show();
        }

        if (window.UIkit) {
            UIkit.lightbox('[uk-lightbox]');
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/dashboard.blade.php ENDPATH**/ ?>