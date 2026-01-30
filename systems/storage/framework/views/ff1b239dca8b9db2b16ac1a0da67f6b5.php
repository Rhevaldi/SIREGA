<?php $__env->startSection('title', 'Program Bansos'); ?>
<?php $__env->startSection('page-title', 'Program Bansos'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('bansos.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Program
            </a>
        </div>

        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <table class="table table-bordered table-striped defaultDataTable">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Program</th>
                        <th>Jenis</th>
                        <th>Penyelenggara</th>
                        <th>Tahun</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $bansos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->nama_program); ?></td>
                            <td><?php echo e(ucfirst($item->jenis)); ?></td>
                            <td><?php echo e($item->penyelenggara); ?></td>
                            <td><?php echo e($item->tahun); ?></td>
                            <td>
                                <div class="btn-group" role="group">

                                    <a href="<?php echo e(route('bansos.edit', $item->id)); ?>"
                                        class="btn btn-warning btn-sm text-nowrap">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="<?php echo e(route('bansos.destroy', $item->id)); ?>" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus program bansos ini?')"
                                        class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm text-nowrap">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/bansos/index.blade.php ENDPATH**/ ?>