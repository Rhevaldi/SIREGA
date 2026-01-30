<?php $__env->startSection('title', 'Tambah Warga'); ?>
<?php $__env->startSection('page-title', 'Tambah Warga'); ?>

<?php $__env->startSection('content'); ?>

    <form action="<?php echo e(route('warga.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row">
            
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Informasi Detail Warga</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        No. Kartu Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="no_kk" class="form-control select2bs4">
                                        <option value="" selected>-- Pilih Kartu Keluarga --</option>
                                        <?php $__currentLoopData = $kartu_keluargas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data->no_kk); ?>"
                                                <?php echo e(old('no_kk') == $data->no_kk ? 'selected' : ''); ?>>
                                                <?php echo e($data->no_kk); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['no_kk'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        NIK <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="nik" class="form-control" value="<?php echo e(old('nik')); ?>">
                                    <?php $__errorArgs = ['nik'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Nama Lengkap <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo e(old('nama')); ?>">
                                    <?php $__errorArgs = ['nama'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Tempat Lahir <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="<?php echo e(old('tempat_lahir')); ?>">
                                    <?php $__errorArgs = ['tempat_lahir'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Tanggal Lahir <span class="text-xs text-danger">*</span>
                                    </label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="<?php echo e(old('tanggal_lahir')); ?>">
                                    <?php $__errorArgs = ['tanggal_lahir'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Jenis Kelamin <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="jenis_kelamin" class="form-control select2">
                                        <option value="">-- Pilih Jenis Kelamin--</option>
                                        <?php $__currentLoopData = $jenis_kelamin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('jenis_kelamin') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

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
                                <div class="form-group mb-3">
                                    <label>
                                        Agama <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="agama" class="form-control select2">
                                        <option value="">-- Pilih Agama --</option>
                                        <?php $__currentLoopData = $religions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('agama') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['agama'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Pendidikan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="pendidikan" class="form-control select2">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('pendidikan') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['pendidikan'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Pekerjaan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="pekerjaan_id" class="form-control select2bs4">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <?php $__currentLoopData = $pekerjaans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pekerjaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($pekerjaan->id); ?>"
                                                <?php echo e(old('pekerjaan_id') == $pekerjaan->id ? 'selected' : ''); ?>>
                                                <?php echo e($pekerjaan->nama); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['pekerjaan_id'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Status Hubungan Dalam Keluarga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_hubungan" class="form-control select2">
                                        <option value="">-- Pilih Status Hubungan --</option>
                                        <?php $__currentLoopData = $status_hubungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('status_hubungan') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

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

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>
                                        Status Perkawinan <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_perkawinan" class="form-control select2">
                                        <option value="">-- Pilih Status Perkawinan --</option>
                                        <?php $__currentLoopData = $status_perkawinan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('status_perkawinan') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['status_perkawinan'];
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
                                <div class="form-group mb-3">
                                    <label>
                                        Status Warga <span class="text-xs text-danger">*</span>
                                    </label>
                                    <select name="status_warga" class="form-control select2">
                                        <option value="">-- Pilih Status Warga --</option>
                                        <?php $__currentLoopData = $status_warga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"
                                                <?php echo e(old('status_warga') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

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
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Indikator Kesejahteraan Masyarakat</h3>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionKategori">
                            <div class="row">
                                <?php $__currentLoopData = $kategoris->groupBy('tipe'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header p-2" id="heading-<?php echo e($tipe); ?>">
                                                <h6 class="mb-0">
                                                    <button class="btn btn-link text-left w-100" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse-<?php echo e($tipe); ?>"
                                                        aria-expanded="false">
                                                        <?php echo e(strtoupper($tipe)); ?>

                                                    </button>
                                                </h6>
                                            </div>

                                            <div id="collapse-<?php echo e($tipe); ?>" class="collapse"
                                                data-parent="#accordionKategori">
                                                <div class="card-body">
                                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="form-group mb-2">
                                                            <label class="small"><?php echo e($kategori->nama); ?></label>
                                                            <select name="kategori[<?php echo e($kategori->id); ?>]"
                                                                class="form-control form-control-sm">

                                                                <option value="" selected>-- Pilih --</option>

                                                                <?php if($kategori->tipe === 'hunian'): ?>
                                                                    <option value="layak"
                                                                        <?php echo e(old("kategori.$kategori->id") == 'layak' ? 'selected' : ''); ?>>
                                                                        Layak Huni</option>
                                                                    <option value="tidak_layak"
                                                                        <?php echo e(old("kategori.$kategori->id") == 'tidak_layak' ? 'selected' : ''); ?>>
                                                                        Tidak Layak Huni</option>
                                                                <?php else: ?>
                                                                    <option value="ya"
                                                                        <?php echo e(old("kategori.$kategori->id") == 'ya' ? 'selected' : ''); ?>>
                                                                        Ya</option>
                                                                    <option value="tidak"
                                                                        <?php echo e(old("kategori.$kategori->id") == 'tidak' ? 'selected' : ''); ?>>
                                                                        Tidak</option>
                                                                <?php endif; ?>

                                                            </select>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-right">
                            <a href="<?php echo e(route('warga.index')); ?>" class="btn btn-secondary"><i
                                    class="fas fa-users mr-1"></i> Daftar Warga</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/warga/create.blade.php ENDPATH**/ ?>