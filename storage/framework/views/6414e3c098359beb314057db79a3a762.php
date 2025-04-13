

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Назначенные задачи</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Название</th>
                                    <th>Статус</th>
                                    <th>Приоритет</th>
                                    <th>Срок</th>
                                    <th>Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($task->id); ?></td>
                                    <td><?php echo e($task->title); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($task->status_color); ?>">
                                            <?php echo e($task->status); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($task->priority_color); ?>">
                                            <?php echo e($task->priority); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e($task->due_date); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="<?php echo e(route('developer.tasks.show', $task->id)); ?>" 
                                               class="btn btn-sm btn-info">
                                                Просмотр
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-success"
                                                    onclick="startTask(<?php echo e($task->id); ?>)">
                                                Начать
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Нет назначенных задач</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function startTask(taskId) {
    if (confirm('Вы уверены, что хотите начать выполнение этой задачи?')) {
        axios.post(`/api/tasks/${taskId}/start`)
            .then(response => {
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ошибка при начале выполнения задачи');
            });
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/developer/tasks.blade.php ENDPATH**/ ?>