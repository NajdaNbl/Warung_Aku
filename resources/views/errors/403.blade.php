<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="font-sans bg-[#FAF5EB] text-[#1F2937]">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-lg">
            <h1 class="text-8xl font-extrabold text-[#1B4332] mb-4">403</h1>
            <div class="w-20 h-1 bg-[#D4A373] mx-auto mb-6"></div>
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Akses Ditolak</h2>
            <p class="text-gray-500 mb-8">Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-3 bg-[#1B4332] text-white font-semibold rounded-xl hover:bg-[#2D6A4F] transition-all duration-300">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
