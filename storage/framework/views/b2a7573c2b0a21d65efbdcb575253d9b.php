

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Панель администратора</div>

                <div class="card-body">
                    <h4>Добро пожаловать, <?php echo e(Auth::user()->name); ?>!</h4>
                    <p>Вы вошли как администратор.</p>

                    <div class="mt-4">
                        <h5>Доступные действия:</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none">Управление пользователями</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none">Управление ролями</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#" class="text-decoration-none">Просмотр статистики</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>