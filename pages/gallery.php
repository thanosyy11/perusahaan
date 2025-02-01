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
        <div class="container mx-auto p-4 mb-14">
            <h2 class="text-3xl font-bold text-white dark:text-white mb-6 text-center">Gallery</h2>
            
            <!-- Container untuk gallery -->
            <div id="gallery-container" class="flex flex-wrap -mx-4">
                <!-- Cards akan ditambahkan di sini secara dinamis -->
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
        // Fungsi untuk memuat dan menampilkan folder
        async function loadGallery() {
            try {
                const response = await fetch('get_folder.php');
                const data = await response.json();
                const galleryContainer = document.getElementById('gallery-container');
                
                if (data.status === "success") {
                    data.folders.forEach(folder => {
                        // Buat card untuk setiap folder
                        const card = createFolderCard(folder);
                        galleryContainer.appendChild(card);
                    });
                } else if (data.status === "empty") {
                    // Tampilkan pesan jika tidak ada folder
                    galleryContainer.innerHTML = `
                <div class="w-full text-center p-8">
                    <p class="text-gray-500 text-lg">
                        ${data.message}
                    </p>
                </div>
            `;
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('gallery-container').innerHTML = `
            <div class="w-full text-center p-8">
                <p class="text-red-500 text-lg">
                    Terjadi kesalahan saat memuat gallery
                </p>
            </div>
        `;
            }
        }

        // Tambahkan fungsi createSpinner
        function createSpinner() {
            const spinner = document.createElement('div');
            spinner.id = 'delete-spinner';
            spinner.className = 'fixed inset-0 bg-white bg-opacity-90 z-50 flex items-center justify-center';
            spinner.innerHTML = `
                <div class="text-center">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `;
            return spinner;
        }

        // Update fungsi createFolderCard untuk menambahkan modal delete
        function createFolderCard(folder) {
            const card = document.createElement('div');
            card.className = 'w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4';
            
            card.innerHTML = `
                <div class="bg-white/90 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-folder text-yellow-400 text-3xl mr-3"></i>
                                <h3 class="text-lg font-semibold text-gray-800 truncate">
                                    ${folder.folder_name}
                                </h3>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mt-4">
                            <div class="flex gap-2">
                                <button 
                                    onclick="viewFolder(${folder.folder_id})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center">
                                    <i class="fas fa-images mr-2"></i>
                                    Lihat Foto
                                </button>
                                <button 
                                    onclick="showDeleteModal(${folder.folder_id}, '${folder.folder_name}')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors duration-300 flex items-center">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Hapus
                                </button>
                            </div>
                            <span class="text-sm text-gray-500">
                                ID: ${folder.folder_id}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div id="deleteModal${folder.folder_id}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <button type="button" onclick="closeDeleteModal(${folder.folder_id})" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus folder "${folder.folder_name}" beserta semua foto di dalamnya?</p>
                            <div class="flex justify-center items-center space-x-4">
                                <button onclick="closeDeleteModal(${folder.folder_id})" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10">
                                    Tidak
                                </button>
                                <button onclick="confirmDeleteFolder(${folder.folder_id})" type="button" class="py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    Ya, Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            return card;
        }

        // Fungsi untuk melihat isi folder
        function viewFolder(folderId) {
            window.location.href = `gallery_list.php?folder_id=${folderId}`;
        }

        // Fungsi untuk menampilkan modal delete
        function showDeleteModal(folderId) {
            const modal = document.getElementById(`deleteModal${folderId}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        // Fungsi untuk menutup modal delete
        function closeDeleteModal(folderId) {
            const modal = document.getElementById(`deleteModal${folderId}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Fungsi untuk konfirmasi dan proses delete folder
        async function confirmDeleteFolder(folderId) {
            try {
                // Tutup modal delete
                closeDeleteModal(folderId);
                
                // Tampilkan spinner
                const spinner = createSpinner();
                document.body.appendChild(spinner);

                const response = await fetch('delete_folder.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        folder_id: folderId
                    })
                });

                const data = await response.json();
                
                // Tunggu 2 detik
                await new Promise(resolve => setTimeout(resolve, 2000));
                
                // Hapus spinner
                spinner.remove();
                
                if (data.status === 'success') {
                    // Refresh halaman secara langsung
                    window.location.reload();
                } else {
                    alert('Gagal menghapus folder: ' + data.message);
                }
            } catch (error) {
                console.error('Error:', error);
                // Tunggu 2 detik sebelum menghilangkan spinner
                await new Promise(resolve => setTimeout(resolve, 2000));
                spinner.remove();
                alert('Terjadi kesalahan saat menghapus folder');
            }
        }

        // Panggil fungsi loadGallery saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadGallery);
    </script>
</body>

</html>