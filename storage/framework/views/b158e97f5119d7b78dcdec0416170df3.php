<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Website Desa'); ?> - <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', 'Website Resmi Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'desa tanalum, website desa, pemerintah desa, kutai kartanegara'); ?>">
    <meta name="author" content="<?php echo e(App\Models\Setting::getValue('meta_author', 'Pemerintah Desa Tanalum')); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', 'Website Desa'); ?> - <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', 'Website Resmi Desa Tanalum'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('image', asset('images/og-image.jpg')); ?>">

    <!-- Favicon -->
    <?php $favicon = App\Models\Setting::getValue('site_favicon'); ?>
    <?php if($favicon): ?>
        <link rel="icon" href="<?php echo e(Storage::url($favicon)); ?>" type="image/x-icon">
    <?php else: ?>
        <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
    <?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <!-- Header -->
    <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="<?php echo e(request()->routeIs('home') ? '' : 'pt-24'); ?>">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Back to Top -->
    <button x-data="{ show: false }" x-show="show" x-on:scroll.window="show = window.scrollY > 500"
        x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-cloak
        class="fixed bottom-6 right-6 z-50 p-3 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 transition-colors">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/layouts/app.blade.php ENDPATH**/ ?>