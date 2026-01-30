<?php $__env->startSection('title', 'Laporan Data Warga'); ?>
<?php $__env->startSection('page-title', 'Laporan Data Warga'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="callout callout-warning">
                <h5>
                    <i class="fas fa-file-archive mr-1"></i>
                    Ringkasan Laporan
                </h5>
                <p>Berikut adalah ringkasan laporan data warga yang dapat Anda filter berdasarkan tanggal
                    tertentu. Gunakan form di sebelah kanan untuk memilih rentang tanggal yang diinginkan,
                    kemudian klik tombol <strong>"Generate Laporan"</strong> untuk melihat hasilnya.</p>
            </div>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kepala Keluarga</span>
                            <span class="info-box-number"><?php echo e(number_format($totalKK)); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success">
                            <i class="fas fa-users"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Warga</span>
                            <span class="info-box-number"><?php echo e(number_format($totalWarga)); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning">
                            <i class="fas fa-male"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Laki - Laki</span>
                            <span class="info-box-number"><?php echo e(number_format($totalLaki)); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger">
                            <i class="fas fa-female"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Perempuan</span>
                            <span class="info-box-number"><?php echo e(number_format($totalPerempuan)); ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-filter mr-1"></i>
                        Filterisasi Laporan
                    </h3>
                </div>
                <form action="<?php echo e(route('reports.warga')); ?>" method="GET">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control select2bs4">
                                        <option value="all"
                                            <?php echo e(request('jenis_kelamin', 'all') === 'all' ? 'selected' : ''); ?>>
                                            Semua Jenis Kelamin
                                        </option>
                                        <?php $__currentLoopData = $jenisKelaminList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis_kelamin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($jenis_kelamin); ?>"
                                                <?php echo e(request('jenis_kelamin') === $jenis_kelamin ? 'selected' : ''); ?>>
                                                <?php echo e($jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Warga</label>
                                    <select name="status_warga" class="form-control select2bs4" required>
                                        <option value="all"
                                            <?php echo e(request('status_warga', 'all') === 'all' ? 'selected' : false); ?>>
                                            Semua
                                            Status Warga</option>
                                        <?php $__currentLoopData = $statusWargaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status_warga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($status_warga); ?>"
                                                <?php echo e(request('status_warga') === $status_warga ? 'selected' : false); ?>>
                                                <?php echo e($status_warga); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['status_warga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Status Hubungan</label>
                                    <select name="status_hubungan" class="form-control select2bs4" required>
                                        <option value="all"
                                            <?php echo e(request('status_hubungan', 'all') === 'all' ? 'selected' : false); ?>>
                                            Semua Status Hubungan</option>
                                        <?php $__currentLoopData = $statusHubunganList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status_hubungan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($status_hubungan); ?>"
                                                <?php echo e(request('status_hubungan') === $status_hubungan ? 'selected' : false); ?>>
                                                <?php echo e($status_hubungan); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['status_hubungan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Generate Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Laporan Data Warga
                    </h3>
                    <button class="btn btn-sm btn-success float-right" onclick="cetakLaporan()">
                        <i class="fas fa-print mr-1"></i>
                        Cetak Laporan
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover reportsTable nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Agama</th>
                                    <th>Pendidikan</th>
                                    <th>Jenis Pekerjaan</th>
                                    <th>Status Warga</th>
                                    <th>Status Hubungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($isFiltered && $wargas->count()): ?>
                                    <?php $__currentLoopData = $wargas->groupBy('no_kk'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noKK => $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                        <tr class="bg-light font-weight-bold">
                                            <td colspan="11">
                                                No. Kartu Keluarga : <?php echo e($noKK); ?>

                                            </td>
                                        </tr>

                                        
                                        <?php $__currentLoopData = $anggota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="text-uppercase">
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($data->nama); ?></td>
                                                <td><?php echo e($data->nik); ?></td>
                                                <td><?php echo e($data->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                                                <td><?php echo e($data->tempat_lahir); ?></td>
                                                <td><?php echo e($data->tanggal_lahir->format('d-m-Y')); ?></td>
                                                <td><?php echo e($data->agama); ?></td>
                                                <td><?php echo e($data->pendidikan); ?></td>
                                                <td><?php echo e($data->pekerjaan); ?></td>
                                                <td><?php echo e($data->status_warga); ?></td>
                                                <td><?php echo e($data->status_hubungan); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            Tidak ada data untuk ditampilkan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <?php $__env->startPush('js'); ?>
        <script>
            function cetakLaporan() {
                const queryString = window.location.search;

                if (!queryString) {
                    alert('Silakan lakukan filter terlebih dahulu sebelum mencetak laporan.');
                    return;
                }

                const url = "<?php echo e(route('reports.warga.cetak')); ?>" + queryString;

                // Buka tab baru
                window.open(url, '_blank');
            }
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/reports/warga.blade.php ENDPATH**/ ?>