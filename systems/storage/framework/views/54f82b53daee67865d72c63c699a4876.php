<?php $__env->startSection('title', 'Data Warga'); ?>
<?php $__env->startSection('page-title', 'Data Warga'); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('warga.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Warga
            </a>
        </div>



        <div class="card-body">

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-striped defaultDataTable table-hover nowrap">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            
                            <th>
                                Nama Lengkap
                                <hr class="my-0 border-dark">
                                Status
                            </th>
                            <th>
                                No. KK
                                <hr class="my-0 border-dark">
                                NIK
                            </th>
                            <th>Jenis<br>Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Agama</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan</th>
                            <th>Status<br>Warga</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $wargas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <?php echo e($warga->nama); ?>

                                    <hr class="my-0 border-dark">
                                    <span class="badge badge-dark text-muted text-white text-xs">
                                        <?php echo e($warga->status_perkawinan); ?>

                                    </span>
                                    <span class="badge badge-info text-muted text-white text-xs">
                                        <?php echo e($warga->status_hubungan); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="font-weight-bold">
                                        <?php echo e($warga->no_kk); ?>

                                    </span>
                                    <hr class="my-0 border-dark">
                                    <?php echo e($warga->nik); ?>

                                </td>
                                <td><?php echo e($warga->jenis_kelamin); ?></td>
                                <td><?php echo e($warga->tempat_lahir); ?></td>
                                <td><?php echo e($warga->tanggal_lahir->format('d-m-Y')); ?></td>
                                <td><?php echo e($warga->agama); ?></td>
                                <td><?php echo e($warga->pendidikan); ?></td>
                                <td><?php echo e($warga->pekerjaan?->nama); ?></td>
                                <td class="text-capitalize">
                                    <?php echo e($warga->status_warga); ?>

                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                            data-target="#detailModal<?php echo e($warga->id); ?>">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu py-0" role="menu" style="">
                                            <a class="dropdown-item btnShowKK" href="javascript:;"
                                                data-id="<?php echo e($warga->kartuKeluarga->id); ?>">
                                                <i class="fas fa-users mr-1"></i> Data Keluarga
                                            </a>
                                            <a class="dropdown-item" href="<?php echo e(route('warga.edit', $warga->id)); ?>">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route('warga.destroy', $warga->id)); ?>" method="POST"
                                                onsubmit="return confirm('Hapus data warga ini?')" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="dropdown-item" type="submit" href="javascript:;">
                                                    
                                                    <i class="fas fa-trash mr-2"></i> Hapus
                                                    
                                                </button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                    
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    
    

    
    <?php $__currentLoopData = $wargas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="detailModal<?php echo e($warga->id); ?>" tabindex="-1" data-backdrop="static"
            data-keyboard="false">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Warga</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-12">
                                <h6>
                                    <strong>Informasi Detail Warga</strong>
                                </h6>
                                <div class="row">
                                    <div class="col-6">

                                        <table class="table table-sm table-borderless table-striped">
                                            <tr>
                                                <th width="200">No. KK</th>
                                                <td>: <?php echo e($warga->no_kk); ?></td>
                                            </tr>
                                            <tr>
                                                <th width="200">NIK</th>
                                                <td>: <?php echo e($warga->nik); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama</th>
                                                <td>: <?php echo e($warga->nama); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Jenis Kelamin</th>
                                                <td class="text-uppercase">:
                                                    <?php echo e($warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tempat Lahir</th>
                                                <td class="text-uppercase">: <?php echo e($warga->tempat_lahir); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Lahir</th>
                                                <td>
                                                    : <?php echo e($warga->tanggal_lahir->format('d-m-Y')); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Agama</th>
                                                <td class="text-uppercase">: <?php echo e($warga->agama); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-6">

                                        <table class="table table-sm table-borderless table-striped">
                                            <tr>
                                                <th>Pendidikan</th>
                                                <td class="text-uppercase">: <?php echo e($warga->pendidikan); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan</th>
                                                <td class="text-uppercase">: <?php echo e($warga->pekerjaan?->nama); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Dalam Keluarga</th>
                                                <td class="text-uppercase">: <?php echo e($warga->status_hubungan); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Perkawinan</th>
                                                <td class="text-uppercase">: <?php echo e($warga->status_perkawinan); ?></td>
                                            </tr>
                                            <tr>
                                                <th>Status Warga</th>
                                                <td class="text-uppercase">
                                                    : <?php echo e($warga->status_warga); ?>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>: <?php echo e($warga->kartuKeluarga?->alamat ?? '-'); ?></td>
                                            </tr>
                                            <tr>
                                                <th>RT/RW</th>
                                                <td>:
                                                    <?php echo e($warga->kartuKeluarga?->rt ?? '-'); ?>/<?php echo e($warga->kartuKeluarga?->rw ?? '-'); ?>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <h6>
                                    <strong>Indikator Kesejahteraan Masyarakat</strong>
                                </h6>
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kategori</th>
                                            <th> Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $grouped = $warga->kategori->groupBy('tipe');
                                        ?>

                                        <?php $__empty_1 = true; $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr class="bg-light">
                                                <td colspan="2">
                                                    <strong><?php echo e(ucfirst($tipe)); ?></strong>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="padding-left:20px">
                                                        <b>*</b> <?php echo e($kat->nama); ?>

                                                    </td>
                                                    <td class="text-capitalize">
                                                        <?php echo e($kat->pivot->nilai ?? '-'); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">
                                                    Tidak ada data indikator
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>

                            <div class="col-6">
                                <h6>
                                    <strong>Penerima Bansos</strong>
                                    <a href="" class="text-xs float-right text-primary" data-toggle="modal"
                                        data-target="#bansosModal<?php echo e($warga->id); ?>">
                                        <i class="fas fa-plus"></i> Tambah Bansos
                                    </a>
                                </h6>
                                
                                <table class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Jenis Bansos</th>
                                            <th>Tahun</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $warga->bansos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($b->nama_program); ?></td>
                                                <td><?php echo e($b->tahun); ?></td>
                                                <td>
                                                    <?php echo e($b->pivot->keterangan ?? '-'); ?>

                                                    <br>
                                                    <small class="text-muted">
                                                        <?php echo e($b->pivot->status); ?> • <?php echo e($b->pivot->tanggal_penerimaan); ?>

                                                    </small>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">
                                                    Belum menerima bansos
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            
                        </div>
                    </div>

                </div>
            </div>
        </div>

        
        <div class="modal fade" id="bansosModal<?php echo e($warga->id); ?>" tabindex="-1" data-backdrop="static"
            data-keyboard="false">
            <div class="modal-dialog">
                <form action="<?php echo e(route('bansos-penerima.store')); ?>" method="POST">

                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="warga_id" value="<?php echo e($warga->id); ?>">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Penerima Bansos</h5>
                            <button class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Program Bansos</label>
                                <select name="bansos_id" class="form-control" required>
                                    <option value="">-- Pilih Program --</option>
                                    <?php $__currentLoopData = $bansosList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($b->id); ?>">
                                            <?php echo e($b->nama_program); ?> (<?php echo e($b->tahun); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="calon penerima">Calon Penerima</option>
                                    <option value="penerima">Penerima</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control"></textarea>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-primary">Simpan</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo $__env->make('kk.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/warga/index.blade.php ENDPATH**/ ?>