<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Admin Panel</title>

    <!-- Favicon -->
    <?php 
        $logo = App\Models\Setting::getValue('site_logo', 'slider/logo-tanalum.png');
        $faviconUrl = ($logo && Storage::disk('public')->exists($logo)) ? Storage::url($logo) : asset('favicon.ico');
    ?>
    <link rel="icon" href="<?php echo e($faviconUrl); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
            <!-- Top Navigation -->
            <?php echo $__env->make('admin.partials.topnav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Flash Messages -->
                <?php if(session('success')): ?>
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span><?php echo e(session('success')); ?></span>
                        </div>
                        <button @click="show = false" class="text-green-700 hover:text-green-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                        class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span><?php echo e(session('error')); ?></span>
                        </div>
                        <button @click="show = false" class="text-red-700 hover:text-red-900">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="text-center text-sm text-gray-500">
                    &copy; <?php echo e(date('Y')); ?> Website Desa Tanalum. All rights reserved.
                </div>
            </footer>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/layouts/admin.blade.php ENDPATH**/ ?>