

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Разработчик - Панель управления')); ?></div>

                <div class="card-body">
                    <div class="row mb-4">
                        <!-- Информация о репозитории -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Информация о репозитории</h5>
                                </div>
                                <div class="card-body">
                                    <div class="repo-info">
                                        <h6>Текущая ветка: <span id="currentBranch"><?php echo e($repoInfo->currentBranch ?? 'Загрузка...'); ?></span></h6>
                                        <h6>Последний коммит:</h6>
                                        <div class="commit-info ml-3">
                                            <p>Хэш: <span id="lastCommitHash"><?php echo e($repoInfo->lastCommit->hash ?? 'Загрузка...'); ?></span></p>
                                            <p>Автор: <span id="lastCommitAuthor"><?php echo e($repoInfo->lastCommit->author ?? 'Загрузка...'); ?></span></p>
                                            <p>Дата: <span id="lastCommitDate"><?php echo e($repoInfo->lastCommit->date ?? 'Загрузка...'); ?></span></p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-3" onclick="refreshRepoInfo()">Обновить информацию</button>
                                </div>
                            </div>
                        </div>

                        <!-- Анализ изменений -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Анализ влияния на тесты</h5>
                                </div>
                                <div class="card-body">
                                    <form id="analyzeForm">
                                        <div class="mb-3">
                                            <label for="commitRange" class="form-label">Диапазон коммитов</label>
                                            <input type="text" class="form-control" id="commitRange" 
                                                   placeholder="например: main..feature-branch">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Анализировать изменения</button>
                                    </form>
                                    
                                    <div id="analysisResults" class="mt-4">
                                        <h6>Результаты анализа:</h6>
                                        <div class="list-group">
                                            <?php $__currentLoopData = $impactedTests ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="list-group-item">
                                                <h6><?php echo e($test->name); ?></h6>
                                                <p class="mb-1">Степень влияния: <?php echo e($test->impactLevel); ?></p>
                                                <small>Затронутые файлы: <?php echo e($test->affectedFiles); ?></small>
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
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function refreshRepoInfo() {
    axios.get('/api/repo-info')
        .then(response => {
            const data = response.data;
            document.getElementById('currentBranch').textContent = data.currentBranch;
            document.getElementById('lastCommitHash').textContent = data.lastCommit.hash;
            document.getElementById('lastCommitAuthor').textContent = data.lastCommit.author;
            document.getElementById('lastCommitDate').textContent = data.lastCommit.date;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка при получении информации о репозитории');
        });
}

document.getElementById('analyzeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const commitRange = document.getElementById('commitRange').value;
    
    axios.post('/api/analyze', {
        commitRange: commitRange
    })
    .then(response => {
        // Обновить UI с результатами анализа
        const results = document.getElementById('analysisResults');
        // Обновление DOM с новыми результатами
        // ...
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ошибка при анализе изменений');
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/developer/dashboard.blade.php ENDPATH**/ ?>