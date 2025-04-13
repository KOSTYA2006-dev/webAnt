

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Создание нового кода</h5>
                </div>
                <div class="card-body">
                    <form id="newCodeForm">
                        <div class="mb-3">
                            <label for="title" class="form-label">Название</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label">Описание</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="codeType" class="form-label">Тип кода</label>
                            <select class="form-control" id="codeType" name="code_type" required>
                                <option value="">Выберите тип кода</option>
                                <option value="feature">Новая функциональность</option>
                                <option value="bugfix">Исправление ошибки</option>
                                <option value="refactor">Рефакторинг</option>
                                <option value="test">Тест</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">Код</label>
                            <textarea class="form-control" id="code" name="code" rows="10" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tests" class="form-label">Тесты</label>
                            <textarea class="form-control" id="tests" name="tests" rows="5" 
                                      placeholder="Добавьте тесты для нового кода"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="relatedTasks" class="form-label">Связанные задачи</label>
                            <select class="form-control" id="relatedTasks" name="related_tasks[]" multiple>
                                <?php $__currentLoopData = $tasks ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($task->id); ?>"><?php echo e($task->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Создать</button>
                            <button type="button" class="btn btn-secondary" onclick="previewCode()">
                                Предпросмотр
                            </button>
                        </div>
                    </form>

                    <!-- Модальное окно предпросмотра -->
                    <div class="modal fade" id="previewModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Предпросмотр кода</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <pre><code id="previewCode"></code></pre>
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
document.getElementById('newCodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    axios.post('/api/code/new', Object.fromEntries(formData))
        .then(response => {
            alert('Код успешно создан');
            window.location.href = '/developer/history';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ошибка при создании кода');
        });
});

function previewCode() {
    const code = document.getElementById('code').value;
    document.getElementById('previewCode').textContent = code;
    new bootstrap.Modal(document.getElementById('previewModal')).show();
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\web-ant-main2\resources\views/developer/new-code.blade.php ENDPATH**/ ?>