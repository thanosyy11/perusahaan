<?php
include 'config.php';
$folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;

// Ambil nama folder untuk breadcrumb
$folder_name = "";
if ($folder_id) {
    $stmt = $conn->prepare("SELECT folder_name FROM folder WHERE folder_id = ?");
    $stmt->bind_param("i", $folder_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $folder_name = $row['folder_name'];
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - <?php echo htmlspecialchars($folder_name); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-[Montserrat] bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 text-center">Gallery</h2>

        <!-- Breadcrumbs -->
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="home.php" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="gallery.php" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Gallery</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2"><?php echo htmlspecialchars($folder_name); ?></span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-12 mb-12">
            <!-- Container untuk foto-foto -->
            <div id="photos-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                <!-- Foto-foto akan ditampilkan di sini -->
            </div>
            
            <div class="mt-6 flex justify-center">
                <button onclick="window.location.href='gallery.php'" type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Back to Gallery
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
    function createPhotoCard(photo) {
        const imagePath = `../uploads/${photo.file_name}`;
        return `
            <div class="rounded overflow-hidden shadow-lg flex flex-col">
                <div class="relative flex justify-center">
                    <img class="w-full h-64 object-contain" src="${imagePath}" alt="${photo.title || 'Foto'}" 
                         onclick="openLightbox('${imagePath}', '${photo.title}', '${photo.desc}')">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                </div>
                <div class="px-6 py-4 flex flex-col space-y-2">
                    <div class="font-medium text-lg hover:text-indigo-600 transition duration-500 ease-in-out">
                        ${photo.title || 'Tanpa Judul'}
                    </div>
                    <p id="desc${photo.id}" class="text-gray-500 text-sm">${photo.desc || 'Tidak ada deskripsi'}</p>
                </div>

                <div class="px-6 py-3 flex flex-row items-center justify-center bg-gray-100">
                    <span class="py-1 text-xs font-regular text-gray-900 flex flex-row items-center">
                        <svg height="13px" width="13px" viewBox="0 0 512 512">
                            <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z"/>
                        </svg>
                        <span class="ml-1">${new Date(photo.date).toLocaleDateString()}</span>
                    </span>
                </div>
                
                <div class="px-6 py-4 flex justify-center space-x-4">
                    <div class="border p-2 rounded cursor-pointer hover:bg-blue-500 group" onclick="event.stopPropagation(); toggleEditDesc(${photo.id}, '${photo.desc}')">
                        <i class="fa-regular fa-pen-to-square text-blue-500 group-hover:text-white"></i>
                    </div>
                    <div class="border p-2 rounded cursor-pointer hover:bg-blue-500 group" onclick="event.stopPropagation(); saveNewDesc(${photo.id})">
                        <i class="fa-regular fa-floppy-disk text-blue-500 group-hover:text-white"></i>
                    </div>
                    <div class="border p-2 rounded cursor-pointer hover:bg-blue-500 group" onclick="event.stopPropagation(); document.getElementById('deleteModal${photo.id}').classList.remove('hidden'); document.getElementById('deleteModal${photo.id}').classList.add('flex');">
                        <i class="fa-regular fa-trash-can text-blue-500 group-hover:text-white"></i>
                    </div>
                    <div class="border p-2 rounded cursor-pointer hover:bg-blue-500 group" onclick="event.stopPropagation(); downloadPhoto('${imagePath}', '${photo.file_name}')">
                        <i class="fa-solid fa-download text-blue-500 group-hover:text-white"></i>
                    </div>
                </div>

                <!-- Text area untuk edit deskripsi (hidden by default) -->
                <div id="editDesc${photo.id}" class="px-6 py-4 hidden">
                    <label for="message${photo.id}" class="block mb-2 text-sm font-medium text-gray-900">Ubah Deskripsi:</label>
                    <textarea 
                        id="message${photo.id}" 
                        rows="4" 
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis deskripsi baru..."
                    >${photo.desc}</textarea>
                </div>

                <!-- Modal delete -->
                <div id="deleteModal${photo.id}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                        <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                            <button type="button" onclick="closeDeleteModal(${photo.id})" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah Anda yakin ingin menghapus foto ini?</p>
                            <div class="flex justify-center items-center space-x-4">
                                <button onclick="closeDeleteModal(${photo.id})" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Tidak
                                </button>
                                <button onclick="confirmDelete(${photo.id}, '${photo.file_name}')" type="button" class="py-2 px-3 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                    Ya, Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function openLightbox(imagePath, title, desc) {
        const lightbox = document.createElement('div');
        lightbox.className = 'fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50';
        lightbox.innerHTML = `
            <div class="max-w-4xl w-full mx-4">
                <img src="${imagePath}" alt="${title}" class="max-h-[80vh] w-auto mx-auto"/>
                <div class="text-white p-4">
                    <h3 class="text-xl font-bold">${title}</h3>
                    <p class="mt-2">${desc}</p>
                </div>
            </div>
        `;
        lightbox.addEventListener('click', () => lightbox.remove());
        document.body.appendChild(lightbox);
    }

    // Fungsi untuk toggle text area
    function toggleEditDesc(photoId, currentDesc) {
        event.stopPropagation();
        const editArea = document.getElementById(`editDesc${photoId}`);
        const textarea = document.getElementById(`message${photoId}`);
        
        if (editArea.classList.contains('hidden')) {
            // Tampilkan text area
            editArea.classList.remove('hidden');
            // Set nilai deskripsi saat ini
            textarea.value = currentDesc || ''; // Tambahkan fallback empty string
            // Focus ke textarea
            textarea.focus();
        } else {
            // Sembunyikan text area
            editArea.classList.add('hidden');
        }
    }

    // Fungsi untuk menutup modal yang diperbaiki
    function closeDeleteModal(photoId) {
        const modal = document.getElementById(`deleteModal${photoId}`);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    // Tambahkan event listener untuk menutup modal saat klik di luar modal
    document.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('[id^="deleteModal"]');
        modals.forEach(modal => {
            if (event.target === modal) {
                const photoId = modal.id.replace('deleteModal', '');
                closeDeleteModal(photoId);
            }
        });
    });

    // Fungsi createSpinner yang benar
    function createSpinner() {
        const spinner = document.createElement('div');
        spinner.id = 'spinner';
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
                <p class="mt-2 text-gray-600">Mohon tunggu...</p>
            </div>
        `;
        return spinner;
    }

    // Update fungsi confirmDelete
    async function confirmDelete(photoId, fileName) {
        try {
            // Tutup modal delete
            closeDeleteModal(photoId);
            
            // Tampilkan spinner
            const spinner = createSpinner();
            document.body.appendChild(spinner);

            const response = await fetch('delete_photo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    photo_id: photoId,
                    file_name: fileName
                })
            });

            const data = await response.json();
            
            // Tunggu 2 detik
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            // Hapus spinner
            spinner.remove();
            
            if (data.status === 'success') {
                // Refresh gallery
                loadPhotos();
            } else {
                alert('Gagal menghapus foto: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            // Tunggu 2 detik sebelum menghilangkan spinner
            await new Promise(resolve => setTimeout(resolve, 2000));
            spinner.remove();
            alert('Terjadi kesalahan saat menghapus foto');
        }
    }

    // Update fungsi downloadPhoto dengan spinner
    async function downloadPhoto(imagePath, fileName) {
        // Tampilkan spinner
        const spinner = createSpinner();
        document.body.appendChild(spinner);

        try {
            const link = document.createElement('a');
            link.href = imagePath;
            link.download = fileName;
            document.body.appendChild(link);
            
            // Tunggu 1 detik sebelum mulai download
            await new Promise(resolve => setTimeout(resolve, 1000));
            
            link.click();
            document.body.removeChild(link);
            
            // Tunggu 1 detik lagi sebelum menghilangkan spinner
            await new Promise(resolve => setTimeout(resolve, 1000));
        } catch (error) {
            console.error('Error downloading:', error);
        } finally {
            // Hapus spinner
            spinner.remove();
        }
    }

    // Fungsi untuk menyimpan deskripsi baru
    async function saveNewDesc(photoId) {
        event.stopPropagation();
        const textarea = document.getElementById(`message${photoId}`);
        const newDesc = textarea.value;
        const editArea = document.getElementById(`editDesc${photoId}`);
        
        // Tampilkan spinner
        const spinner = createSpinner();
        document.body.appendChild(spinner);
        
        try {
            const response = await fetch('update_description.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    photo_id: photoId,
                    description: newDesc
                })
            });

            const data = await response.json();
            
            // Tunggu 2 detik
            await new Promise(resolve => setTimeout(resolve, 2000));
            
            if (data.status === 'success') {
                // Update deskripsi di tampilan
                const descElement = document.getElementById(`desc${photoId}`);
                descElement.textContent = newDesc || 'Tidak ada deskripsi';
                
                // Sembunyikan text area
                editArea.classList.add('hidden');
            } else {
                alert('Gagal mengupdate deskripsi: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate deskripsi');
        } finally {
            // Hapus spinner
            spinner.remove();
        }
    }

    async function loadPhotos() {
        const folderId = <?php echo $folder_id ?? 'null'; ?>;
        if (!folderId) {
            showError('ID Folder tidak valid');
            return;
        }

        try {
            const response = await fetch(`get_photos.php?folder_id=${folderId}`);
            const data = await response.json();
            const container = document.getElementById('photos-container');

            if (data.status === "success" && data.photos && data.photos.length > 0) {
                container.innerHTML = data.photos.map(photo => createPhotoCard(photo)).join('');
            } else {
                container.innerHTML = `
                    <div class="col-span-full text-center p-8">
                        <p class="text-gray-500 text-lg">${data.message || 'Tidak ada foto dalam folder ini'}</p>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('photos-container').innerHTML = `
                <div class="col-span-full text-center p-8">
                    <p class="text-red-500 text-lg">Terjadi kesalahan saat memuat foto</p>
                </div>
            `;
        }
    }

    // Load photos when page is ready
    document.addEventListener('DOMContentLoaded', loadPhotos);
    </script>
</body>
</html>