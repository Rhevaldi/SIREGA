<?php $__env->startSection('title', 'Kategori'); ?>
<?php $__env->startSection('page-title', 'Data Kategori'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <a href="<?php echo e(route('kategori.create')); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <table class="table table-bordered defaultDataTable">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($k->kode); ?></td>
                            <td><?php echo e($k->nama); ?></td>
                            <td><?php echo e(ucfirst($k->tipe)); ?></td>
                            <td><?php echo e($k->deskripsi); ?></td>
                            <td>
                                <div class="btn-group" role="group">

                                    <a href="<?php echo e(route('kategori.edit', $k->id)); ?>"
                                        class="btn btn-warning btn-sm text-nowrap">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="<?php echo e(route('kategori.destroy', $k->id)); ?>" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="d-inline">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/kategori/index.blade.php ENDPATH**/ ?>