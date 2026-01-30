<?php $__env->startSection('title', 'Akun Saya'); ?>
<?php $__env->startSection('page-title', 'Akun Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Akun Saya</h3>
                </div>
                <!-- /.card-header -->
                <form action="<?php echo e(route('profile.update', $user->id)); ?>" method="POST">
                    <?php echo method_field('patch'); ?>
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input value="<?php echo e($user->name); ?>" type="text" id="name" name="name"
                                class="form-control" placeholder="Masukkan Nama Lengkap" autofocus>
                            <?php $__errorArgs = ['name'];
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
                        <div class="form-group">
                            <label for="email">Email <code>*</code></label>
                            <input value="<?php echo e($user->email); ?>" type="email" id="email" name="email"
                                class="form-control" placeholder="Masukkan Email">
                            <?php $__errorArgs = ['email'];
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
                        <div class="form-group">
                            <label for="role">Level Akses <code>*</code></label>
                            <select id="role" name="role" class="form-control text-capitalize" disabled>
                                <option selected value=""><?php echo e($user->roles()->first()->name); ?></option>
                            </select>
                            <?php $__errorArgs = ['role'];
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
                        <hr>
                        <div class="form-group">
                            <label for="password">Password <code>*Abaikan jika tidak ingin merubah password</code></label>
                            <input value="<?php echo e(old('password')); ?>" type="password" id="password" name="password"
                                class="form-control" placeholder="Masukkan Password">
                            <?php $__errorArgs = ['password'];
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
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input value="<?php echo e(old('password_confirmation')); ?>" type="password" id="password_confirmation"
                                name="password_confirmation" class="form-control"
                                placeholder="Masukkan Konfirmasi Password">
                            <?php $__errorArgs = ['password_confirmation'];
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
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fas fa-paper-plane"></i> Simpan
                        </button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/profile/edit.blade.php ENDPATH**/ ?>