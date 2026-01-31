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
                                        <button type="button" class="btn btn-default btn-sm detailWarga"
                                            data-warga-id="<?php echo e($warga->id); ?>">
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

    <?php echo $__env->make('warga.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('kk.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/warga/index.blade.php ENDPATH**/ ?>