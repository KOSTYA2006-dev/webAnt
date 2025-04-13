

<?php $__env->startSection('content'); ?>
<div class="container">
    <?php if(session('error')): ?>
        <div class="alert alert-danger mt-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">Система управления тестированием</h1>
            <?php if(auth()->guard()->check()): ?>
                <p class="lead">Добро пожаловать, <?php echo e(Auth::user()->name); ?>!</p>
                <div class="mt-4">
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Перейти в панель управления
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/welcome.blade.php ENDPATH**/ ?>