<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Tambahkan overlay untuk membuat konten lebih mudah dibaca */
        .bg-overlay {
            background-color: rgba(255, 255, 255, 0.9);
            min-height: 100vh;
        }
    </style>
</head>

<body class="font-[Montserrat]">
    <!-- Background dengan opacity dan brightness yang disesuaikan -->
    <div class="fixed inset-0 z-0" style="
        background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), 
        url('bg.jpg') no-repeat center center fixed;
        background-size: cover;
        filter: brightness(50%);
        opacity: 0.2;
    "></div>

    <!-- Konten utama -->
    <div class="relative z-10">
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold text-white dark:text-white mb-6 text-center">Home</h2>
            
            <!-- Card Komitmen -->
            <div class="max-w-sm p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Komitmen</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">CV. Inara Karya<br>Dengan lebih dari 10 tahun pengalaman,</p>
                <p id="more1" class="font-normal text-gray-700 dark:text-gray-400 hidden mb-2">Terus tumbuh berkelanjutan melalui komitmen, kerja keras, serta peningkatan manajemen, SDM, inovasi, dan teknologi.</p>
                <button onclick="toggleReadMore('more1')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>

            <!-- Card Visi & Misi -->
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mb-16">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Visi & Misi</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Visi:<br>Menjadi Perusahaan Kontruksi dan Jasa EPC(Engineering, Procurement, and Construction) Terintegrasi yang Terpercaya dan Berkelanjutan<br></p>
                <p id="more2" class="font-normal text-gray-700 dark:text-gray-400 hidden mb-2">Misi:<br><i class="fa-solid fa-arrow-right"></i>
                    Menyediakan layanan dan produk EPC berkualitas global dengan mengutamakan keselamatan, kesehatan, dan lingkungan.<br><i class="fa-solid fa-arrow-right"></i>
                    Mendorong budaya belajar dan inovasi untuk solusi terbaik serta kepuasan pemangku kepentingan.<br><i class="fa-solid fa-arrow-right"></i>
                    Menjalankan bisnis dengan standar kualitas tinggi dan teknologi terbaik.<br><i class="fa-solid fa-arrow-right"></i>
                    Mengoptimalkan sumber daya untuk pertumbuhan keuangan yang berkelanjutan.<br><i class="fa-solid fa-arrow-right"></i>
                    Menerapkan etika, transparansi, akuntabilitas, dan inovasi dalam operasional perusahaan.<br><i class="fa-solid fa-arrow-right"></i>
                    Mengembangkan sumber daya manusia yang profesional dan berintegritas.</p>
                <button onclick="toggleReadMore('more2')" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Read more
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
        <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
            <a href="home.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                <i class="fa-solid fa-house text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 text-xl"></i>
                <span class="text-sm font-bold text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Home</span>
            </a>
            <a href="upload.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                <i class="fa-solid fa-file-arrow-up text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 text-xl"></i>
                <span class="text-sm font-bold text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Upload</span>
            </a>
            <a href="gallery.php" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                <i class="fa-regular fa-image text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 text-xl"></i>
                <span class="text-sm font-bold text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500">Gallery</span>
            </a>
        </div>
    </div>

    <script>
        function toggleReadMore(id) {
            var content = document.getElementById(id);
            if (content.style.display === "none") {
                content.style.display = "block";
            } else {
                content.style.display = "none";
            }
        }
    </script>
</body>

</html>