<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link font-italic font-weight-bold" data-toggle="dropdown" href="#">
                <?php echo e(env('APP_NAME')); ?>

            </a>
            <div class="dropdown-menu dropdown-menu-right">
                

                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button class="dropdown-item text-danger">Logout</button>
                </form>
            </div>
        </li>
    </ul>

</nav>
<?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>