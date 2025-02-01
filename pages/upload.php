<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
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
            <h2 class="text-3xl font-bold text-white dark:text-white mb-6 text-center">Upload</h2>
            <section class="bg-white/90 shadow-lg rounded-lg p-6 max-w-3xl mx-auto mb-6">
                <form id="folderForm" class="max-w-sm mx-auto space-y-5">
                    <div id="alertContainer"></div>
                    <!-- Input Folder Baru -->
                    <div>
                        <label for="folder_baru" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Folder Baru*
                        </label>
                        <input
                            type="text"
                            id="folder_baru"
                            name="folder_baru"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Masukkan nama folder"
                            required />
                    </div>
                    <!-- Tombol Submit -->
                    <div>
                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                    </div>
                </form>
            </section>

            <section class="bg-white/90 shadow rounded-lg p-6 max-w-3xl mx-auto">
                <form id="uploadForm" enctype="multipart/form-data" class="space-y-6 max-w-sm mx-auto">
                    <!-- Pilih Folder -->
                    <div>
                        <label for="folder" class="block text-sm font-medium text-gray-900 dark:text-white">Pilih Folder*</label>
                        <select id="folder" name="folder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-12 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="" disabled selected>Pilih folder...</option>
                        </select>
                    </div>

                    <!-- Judul -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-900 dark:text-white">Judul*</label>
                        <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-12 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan judul" required />
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="desc" class="block text-sm font-medium text-gray-900 dark:text-white">Deskripsi*</label>
                        <input type="text" id="desc" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-12 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan deskripsi" required />
                    </div>

                    <!-- Upload File -->
                    <div>
                        <label for="multiple_files" class="block text-sm font-medium text-gray-900 dark:text-white">Upload File*</label>
                        <input id="multiple_files" name="multiple_files[]" type="file" multiple class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5 h-12 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required />
                        <p class="block text-sm font-medium text-gray-400 dark:text-white">*semua item wajib di isi</p>
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit" id="uploadButton" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                    </div>
                </form>
            </section>

        </div>

        <!-- navigation -->
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
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const uploadForm = document.getElementById("uploadForm");
            const folderSelect = document.getElementById("folder");
            
            // Mencegah form dari submit default
            uploadForm.addEventListener("submit", async function(e) {
                e.preventDefault();
                
                const files = document.getElementById('multiple_files').files;
                if (files.length === 0) {
                    showAlert("error", "Pilih file terlebih dahulu");
                    return;
                }
                
                // Validasi tipe file
                for (let file of files) {
                    if (!file.type.startsWith('image/')) {
                        showAlert("error", "Hanya file gambar yang diperbolehkan");
                        return;
                    }
                }
                
                const formData = new FormData(uploadForm);
                
                try {
                    const response = await fetch("upload_foto.php", {  // Pastikan path ini benar
                        method: "POST",
                        body: formData  // FormData akan otomatis mengatur Content-Type
                    });
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    
                    const data = await response.json();
                    showAlert(data.status, data.message);
                    
                    if (data.status === "success") {
                        uploadForm.reset();
                    }
                } catch (error) {
                    console.error("Error:", error);
                    showAlert("error", "Terjadi kesalahan saat upload");
                }
            });

            // Fungsi untuk mengambil daftar folder dari server
            async function loadFolders() {
                try {
                    const response = await fetch("get_folder.php");
                    const data = await response.json();

                    folderSelect.innerHTML = '<option value="" disabled selected>Pilih folder...</option>';

                    if (data.status === "success") {
                        data.folders.forEach(folder => {
                            const option = document.createElement("option");
                            option.value = folder.folder_id;
                            option.textContent = folder.folder_name;
                            folderSelect.appendChild(option);
                        });
                    } else {
                        const option = document.createElement("option");
                        option.textContent = "Tidak ada folder tersedia";
                        option.disabled = true;
                        folderSelect.appendChild(option);
                    }
                } catch (error) {
                    console.error("Error loading folders:", error);
                }
            }

            loadFolders(); // Panggil saat halaman dimuat

            // Menangani pembuatan folder baru
            document.getElementById("folderForm").addEventListener("submit", async function(e) {
                e.preventDefault();
                const submitButton = this.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin h-5 w-5 mr-3" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                `;
                
                const folderName = document.getElementById("folder_baru").value.trim();
                if (!folderName) {
                    showAlert("error", "Nama folder tidak boleh kosong!");
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'Submit';
                    return;
                }

                try {
                    const response = await fetch("create_folder.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            folder_baru: folderName
                        })
                    });

                    const result = await response.json();
                    showAlert(result.status, result.message);

                    if (result.status === "success") {
                        document.getElementById("folder_baru").value = ""; // Reset input setelah sukses
                        loadFolders(); // Perbarui daftar folder
                    }
                } catch (error) {
                    console.error("Error creating folder:", error);
                }
                
                // Setelah selesai
                submitButton.disabled = false;
                submitButton.innerHTML = 'Submit';
            });

            // Fungsi global untuk menampilkan notifikasi
            function showAlert(status, message) {
                const alertContainer = document.getElementById("alertContainer");
                alertContainer.innerHTML = `
                    <div class="px-6 py-4 rounded-lg text-lg flex items-center w-full
                        ${status === "success" ? "bg-green-100 text-green-800 border border-green-200" : "bg-red-100 text-red-800 border border-red-200"}">
                        <i class="fas ${status === "success" ? "fa-check-circle" : "fa-times-circle"} w-5 h-5 mr-3"></i>
                        <span class="flex-1">${message}</span>
                    </div>
                `;

                // Hapus alert setelah 2 detik
                setTimeout(() => {
                    alertContainer.innerHTML = "";
                }, 2000);
            }
        });
    </script>
</body>

</html>