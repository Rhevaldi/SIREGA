<?php $__env->startSection('title', 'Data Kartu Keluarga'); ?>
<?php $__env->startSection('page-title', 'Data Kartu Keluarga'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mt-1">Daftar Kartu Keluarga</h3>
                    <a href="<?php echo e(route('kk.create')); ?>" class="btn btn-sm btn-primary float-right">
                        <i class="fas fa-plus"></i> KK Baru
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="kkTable" class="table table-bordered table-hover text-nowrap defaultDataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>No KK</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Desa/Kelurahan</th>
                                    <th class="text-center">Latitude</th>
                                    <th class="text-center">Longitude</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <?php echo e($kk->no_kk); ?>

                                        </td>
                                        <td>
                                            <?php echo e($kk->nama_kepala_keluarga ?? 'null'); ?>

                                        </td>
                                        <td>
                                            <?php echo e($kk->desa); ?>

                                        </td>
                                        <td class="text-center">
                                            <?php echo e($kk->latitude); ?>

                                        </td>
                                        <td class="text-center">
                                            <?php echo e($kk->longitude); ?>

                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info btn-sm text-nowrap btnShowKK"
                                                    data-id="<?php echo e($kk->id); ?>">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>

                                                <a class="btn btn-warning btn-sm" href="<?php echo e(route('kk.edit', $kk->id)); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>

                                                <form action="<?php echo e(route('kk.destroy', $kk->id)); ?>" method="POST"
                                                    style="display: inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kartu keluarga ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>No KK</th>
                                    <th>Nama Kepala Keluarga</th>
                                    <th>Desa/Kelurahan</th>
                                    <th class="text-center">Latitude</th>
                                    <th class="text-center">Longitude</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <?php echo $__env->make('kk.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('warga.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/kk/index.blade.php ENDPATH**/ ?>