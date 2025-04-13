

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Тестировщик - Панель управления')); ?></div>

                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Загрузка материалов -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Загрузка материалов</h5>
                                </div>
                                <div class="card-body">
                                    <form action="<?php echo e(route('tester.upload-materials')); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <div class="mb-3">
                                            <label for="materials" class="form-label">Выберите файлы</label>
                                            <input type="file" class="form-control" id="materials" name="materials[]" multiple>
                                            <small class="text-muted">Поддерживаемые форматы: PNG, JPG, MP4, PDF</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Описание</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Загрузить</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Ревью тест-кейсов -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Ревью тест-кейсов</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <?php $__currentLoopData = $testCases ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testCase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="list-group-item">
                                            <h6><?php echo e($testCase->title); ?></h6>
                                            <p class="mb-1"><?php echo e($testCase->description); ?></p>
                                            <div class="btn-group">
                                                <a href="<?php echo e(route('tester.test-cases.show', $testCase->id)); ?>" 
                                                   class="btn btn-sm btn-info">Просмотр</a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-success"
                                                        onclick="approveTestCase(<?php echo e($testCase->id); ?>)">
                                                    Подтвердить
                                                </button>
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="rejectTestCase(<?php echo e($testCase->id); ?>)">
                                                    Отклонить
                                                </button>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function approveTestCase(id) {
    axios.post(`/api/test-cases/${id}/review`, {
        status: 'approved'
    }).then(response => {
        // Обновить UI после успешного подтверждения
        location.reload();
    }).catch(error => {
        console.error('Error:', error);
        alert('Произошла ошибка при подтверждении тест-кейса');
    });
}

function rejectTestCase(id) {
    const reason = prompt('Укажите причину отклонения:');
    if (reason) {
        axios.post(`/api/test-cases/${id}/review`, {
            status: 'rejected',
            reason: reason
        }).then(response => {
            // Обновить UI после успешного отклонения
            location.reload();
        }).catch(error => {
            console.error('Error:', error);
            alert('Произошла ошибка при отклонении тест-кейса');
        });
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/tester/dashboard.blade.php ENDPATH**/ ?>