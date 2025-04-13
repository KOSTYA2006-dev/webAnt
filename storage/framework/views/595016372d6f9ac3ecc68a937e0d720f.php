

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">История изменений</h5>
                </div>
                <div class="card-body">
                    <!-- Фильтры -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="dateRange" class="form-label">Период</label>
                            <select class="form-control" id="dateRange">
                                <option value="today">Сегодня</option>
                                <option value="week">Последняя неделя</option>
                                <option value="month">Последний месяц</option>
                                <option value="custom">Произвольный период</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="author" class="form-label">Автор</label>
                            <select class="form-control" id="author">
                                <option value="">Все авторы</option>
                                <?php $__currentLoopData = $authors ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($author->id); ?>"><?php echo e($author->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="branch" class="form-label">Ветка</label>
                            <select class="form-control" id="branch">
                                <option value="">Все ветки</option>
                                <?php $__currentLoopData = $branches ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($branch); ?>"><?php echo e($branch); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="type" class="form-label">Тип изменений</label>
                            <select class="form-control" id="type">
                                <option value="">Все типы</option>
                                <option value="feature">Новая функциональность</option>
                                <option value="bugfix">Исправление ошибки</option>
                                <option value="refactor">Рефакторинг</option>
                                <option value="test">Тесты</option>
                            </select>
                        </div>
                    </div>

                    <!-- История изменений -->
                    <div class="timeline">
                        <?php $__empty_1 = true; $__currentLoopData = $changes ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $change): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-<?php echo e($change->type_color); ?>"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1"><?php echo e($change->title); ?></h6>
                                    <small><?php echo e($change->created_at->format('d.m.Y H:i')); ?></small>
                                </div>
                                <p class="mb-1"><?php echo e($change->description); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-<?php echo e($change->type_color); ?>"><?php echo e($change->type); ?></span>
                                        <small class="text-muted">Автор: <?php echo e($change->author); ?></small>
                                        <small class="text-muted">Ветка: <?php echo e($change->branch); ?></small>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" 
                                                class="btn btn-sm btn-info"
                                                onclick="viewDiff('<?php echo e($change->id); ?>')">
                                            Изменения
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-secondary"
                                                onclick="viewTests('<?php echo e($change->id); ?>')">
                                            Тесты
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center">
                            <p>История изменений пуста</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно для просмотра изменений -->
<div class="modal fade" id="diffModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Изменения</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <pre><code id="diffContent"></code></pre>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно для просмотра тестов -->
<div class="modal fade" id="testsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Тесты</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <pre><code id="testsContent"></code></pre>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-item {
    position: relative;
    padding: 20px 0;
    padding-left: 30px;
    border-left: 2px solid #e9ecef;
    margin-left: 20px;
}

.timeline-marker {
    position: absolute;
    left: -11px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid currentColor;
}

.timeline-content {
    background: #fff;
    padding: 15px;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12);
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Обработка фильтров
document.querySelectorAll('select').forEach(select => {
    select.addEventListener('change', function() {
        applyFilters();
    });
});

function applyFilters() {
    const filters = {
        dateRange: document.getElementById('dateRange').value,
        author: document.getElementById('author').value,
        branch: document.getElementById('branch').value,
        type: document.getElementById('type').value
    };
    
    axios.get('/api/changes', { params: filters })
        .then(response => {
            // Обновление списка изменений
            // Здесь должна быть логика обновления DOM
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка при получении истории изменений');
        });
}

function viewDiff(changeId) {
    axios.get(`/api/changes/${changeId}/diff`)
        .then(response => {
            document.getElementById('diffContent').textContent = response.data.diff;
            new bootstrap.Modal(document.getElementById('diffModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка при получении изменений');
        });
}

function viewTests(changeId) {
    axios.get(`/api/changes/${changeId}/tests`)
        .then(response => {
            document.getElementById('testsContent').textContent = response.data.tests;
            new bootstrap.Modal(document.getElementById('testsModal')).show();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка при получении тестов');
        });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/developer/history.blade.php ENDPATH**/ ?>