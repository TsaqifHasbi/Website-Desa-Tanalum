<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Dalam Perbaikan</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center p-4">
    <div class="text-center text-white max-w-md">
        <div class="mb-8">
            <i class="fas fa-tools text-6xl animate-bounce-slow"></i>
        </div>
        <h1 class="text-3xl font-bold mb-4">Website Dalam Perbaikan</h1>
        <p class="text-lg text-white/80 mb-8">{{ $message }}</p>
        <a href="{{ route('login') }}"
            class="inline-flex items-center px-6 py-3 bg-white text-primary-600 hover:bg-gray-100 font-semibold rounded-lg transition">
            <i class="fas fa-user-shield mr-2"></i>
            Login Admin
        </a>
    </div>
</body>

</html>
