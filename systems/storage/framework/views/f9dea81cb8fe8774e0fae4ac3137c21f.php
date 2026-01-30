<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?php echo e(env('APP_TITLE')); ?> <?php echo $__env->yieldContent('title', 'SIREGA - Login'); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset(env('APP_FAVICON_PATH'))); ?>" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?php echo e(asset('adminlte/css/adminlte.min.css')); ?>">
</head>

<body class="hold-transition login-page">

    <?php echo $__env->yieldContent('content'); ?>

    <!-- jQuery -->
    <script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE -->
    <script src="<?php echo e(asset('adminlte/js/adminlte.min.js')); ?>"></script>
</body>

</html>
<?php /**PATH /Applications/ServBay/www/sirega/systems/resources/views/layouts/auth.blade.php ENDPATH**/ ?>