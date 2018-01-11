<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo $__env->yieldContent('title'); ?></title>

        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> 

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="/css/custom.css" rel="stylesheet">
     
    </head>
    <body>
    
        <?php echo $__env->make('layouts.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    
        <?php echo $__env->yieldContent('content'); ?>
    
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    
    </body>
</html>