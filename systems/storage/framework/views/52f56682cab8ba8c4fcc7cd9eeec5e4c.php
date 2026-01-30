<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo e(route('dashboard')); ?>" class="brand-link">
        <img src="<?php echo e(asset(env('APP_LOGO_PATH'))); ?>" alt="AdminLTE Logo" class="brand-image mx-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">SIREGA</span>
    </a>

    <div class="sidebar">


        <div class="user-panel py-2 d-flex">
            <div class="image mt-2">
                <img src="<?php echo e(asset('adminlte/img/user1-128x128.jpg')); ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-uppercase">
                    <?php echo e(auth()->user()->name); ?>

                </a>
                <small class="d-block text-muted text-capitalize"><?php echo e(auth()->user()->roles()->first()->name); ?></small>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">


                <li class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>"
                        class="nav-link <?php echo e(request()->is('dashboard*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                    <div class="nav-header">MANAJEMEN DATA</div>
                    
                    
                    <li class="nav-item">
                        <a href="<?php echo e(route('kk.index')); ?>" class="nav-link <?php echo e(request()->is('kk*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>Kartu Keluarga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo e(route('warga.index')); ?>"
                            class="nav-link <?php echo e(request()->is('warga*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>Data Warga</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('media_warga.index')); ?>"
                            class="nav-link <?php echo e(request()->is('media_warga*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Media Warga</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="<?php echo e(route('kategori.index')); ?>"
                            class="nav-link <?php echo e(request()->is('kategori*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-balance-scale"></i>
                            <p>Indikator Warga</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="<?php echo e(route('bansos.index')); ?>"
                            class="nav-link <?php echo e(request()->is('bansos*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-hand-holding-heart"></i>
                            <p>Program Bansos</p>
                        </a>
                    </li>


                    <div class="nav-header">LAPORAN</div>
                    <li class="nav-item">
                        <a href="<?php echo e(route('reports.warga')); ?>"
                            class="nav-link <?php echo e(request()->routeIs('reports.warga') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Data Warga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-archive"></i>
                            <p>Penerima Bantuan</p>
                        </a>
                    </li>
                <?php endif; ?>

                <div class="nav-header">SISTEM</div>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'superadmin')): ?>
                    <li class="nav-item">
                        <a href="<?php echo e(route('users.index')); ?>"
                            class="nav-link <?php echo e(request()->is('users*') ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('profile.edit')); ?>"
                        class="nav-link <?php echo e(request()->is('profile') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>Akun Saya</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="nav-link btn btn-link text-left text-white">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
<?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>