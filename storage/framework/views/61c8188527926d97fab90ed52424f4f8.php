<!-- Основная навигация -->
<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Логотип -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="text-xl font-bold text-gray-800">
                        <?php echo e(config('app.name', 'Laravel')); ?>

                    </a>
                </div>

                <!-- Навигационные ссылки -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 
                                  <?php echo e(request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                            Панель управления
                        </a>

                        <!-- Меню для разработчика -->
                        <?php if(auth()->user()->hasRole('developer')): ?>
                            <a href="<?php echo e(route('developer.tasks')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('developer.tasks') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Просмотр задач
                            </a>
                            <a href="<?php echo e(route('developer.new-code')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('developer.new-code') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Новый код
                            </a>
                            <a href="<?php echo e(route('developer.history')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('developer.history') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                История
                            </a>
                        <?php endif; ?>

                        <!-- Меню для тестировщика -->
                        <?php if(auth()->user()->hasRole('tester')): ?>
                            <a href="<?php echo e(route('tester.tasks')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('tester.tasks') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Задачи
                            </a>
                            <a href="<?php echo e(route('tester.test-cases')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('tester.test-cases') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Тест-кейсы
                            </a>
                        <?php endif; ?>

                        <!-- Меню для администратора -->
                        <?php if(auth()->user()->hasRole('admin')): ?>
                            <a href="<?php echo e(route('admin.users')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('admin.users') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Пользователи
                            </a>
                            <a href="<?php echo e(route('admin.settings')); ?>"
                               class="inline-flex items-center px-1 pt-1 border-b-2
                                      <?php echo e(request()->routeIs('admin.settings') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'); ?>">
                                Настройки
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Правая часть навигации -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <?php if(auth()->guard()->check()): ?>
                    <div class="ml-3 relative">
                        <div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
                            <div @click="open = !open">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div><?php echo e(Auth::user()->name); ?></div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                            Выйти
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Мобильное меню -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Мобильное меню (развернутое) -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('dashboard')); ?>" 
                   class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium <?php echo e(request()->routeIs('dashboard') ? 'border-indigo-400 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'); ?>">
                    Панель управления
                </a>

                <!-- Мобильное меню для разных ролей -->
                <?php if(auth()->user()->hasRole('developer')): ?>
                    <!-- Пункты меню разработчика -->
                <?php endif; ?>

                <?php if(auth()->user()->hasRole('tester')): ?>
                    <!-- Пункты меню тестировщика -->
                <?php endif; ?>

                <?php if(auth()->user()->hasRole('admin')): ?>
                    <!-- Пункты меню администратора -->
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Мобильное меню профиля -->
        <?php if(auth()->guard()->check()): ?>
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800"><?php echo e(Auth::user()->name); ?></div>
                        <div class="font-medium text-sm text-gray-500"><?php echo e(Auth::user()->email); ?></div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="block w-full px-4 py-2 text-left text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                            Выйти
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav> <?php /**PATH C:\web-ant-main2\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>