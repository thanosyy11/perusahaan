<?php
header("Content-Type: application/json");
include 'config.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uploadDir = "../uploads/";
        
        // Debug: cek request yang masuk
        error_log("POST data: " . print_r($_POST, true));
        error_log("FILES data: " . print_r($_FILES, true));
        
        // Buat folder jika belum ada
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Gagal membuat direktori upload");
            }
        }

        // Validasi input
        if (empty($_POST['folder'])) {
            throw new Exception("Folder harus dipilih");
        }
        if (empty($_POST['title'])) {
            throw new Exception("Judul harus diisi");
        }
        if (empty($_POST['desc'])) {
            throw new Exception("Deskripsi harus diisi");
        }

        $folder_id = $_POST['folder'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $uploadedFiles = [];
        $uploadErrors = [];

        // Cek apakah ada file yang diupload
        if (!isset($_FILES['multiple_files']) || empty($_FILES['multiple_files']['name'][0])) {
            throw new Exception("Tidak ada file yang dipilih");
        }

        // Validasi koneksi database
        if (!$conn) {
            throw new Exception("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Proses upload file
        foreach ($_FILES['multiple_files']['name'] as $index => $fileName) {
            // Validasi error upload
            if ($_FILES['multiple_files']['error'][$index] !== UPLOAD_ERR_OK) {
                $uploadErrors[] = "Error pada file {$fileName}: " . 
                                getUploadErrorMessage($_FILES['multiple_files']['error'][$index]);
                continue;
            }

            // Validasi tipe file (opsional, sesuaikan dengan kebutuhan)
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['multiple_files']['type'][$index];
            if (!in_array($fileType, $allowedTypes)) {
                $uploadErrors[] = "Tipe file {$fileName} tidak didukung. Hanya jpg, png, dan gif yang diizinkan.";
                continue;
            }

            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = uniqid() . '.' . $fileExt;
            $filePath = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['multiple_files']['tmp_name'][$index], $filePath)) {
                $relativePath = "uploads/" . $newFileName;
                
                // Sesuaikan dengan struktur tabel yang benar
                $sql = "INSERT INTO foto (file_name, folder_id, file_path, `desc`, date, title) 
                        VALUES (?, ?, ?, ?, NOW(), ?)";
                $stmt = $conn->prepare($sql);
                
                if (!$stmt) {
                    throw new Exception("Prepare statement error: " . $conn->error);
                }
                
                // Tambahkan file_name ke binding parameter
                $stmt->bind_param("sisss", 
                    $fileName,      // file_name (original filename)
                    $folder_id,     // folder_id
                    $relativePath,  // file_path
                    $desc,          // desc
                    $title          // title
                );
                
                if (!$stmt->execute()) {
                    throw new Exception("Execute statement error: " . $stmt->error);
                }
                
                $uploadedFiles[] = $relativePath;
                $stmt->close();
            } else {
                $uploadErrors[] = "Gagal memindahkan file {$fileName}";
            }
        }

        // Response
        if (!empty($uploadedFiles)) {
            echo json_encode([
                "status" => "success",
                "message" => "File berhasil diunggah",
                "files" => $uploadedFiles,
                "errors" => $uploadErrors
            ]);
        } else {
            throw new Exception("Tidak ada file yang berhasil diunggah");
        }

    } catch (Exception $e) {
        error_log("Upload error: " . $e->getMessage());
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage(),
            "errors" => $uploadErrors
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Method tidak diizinkan"
    ]);
}

// Fungsi helper untuk mendapatkan pesan error upload
function getUploadErrorMessage($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
            return "File terlalu besar (melebihi upload_max_filesize di php.ini)";
        case UPLOAD_ERR_FORM_SIZE:
            return "File terlalu besar (melebihi MAX_FILE_SIZE di form HTML)";
        case UPLOAD_ERR_PARTIAL:
            return "File hanya terupload sebagian";
        case UPLOAD_ERR_NO_FILE:
            return "Tidak ada file yang diupload";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Folder temporary tidak ditemukan";
        case UPLOAD_ERR_CANT_WRITE:
            return "Gagal menulis file ke disk";
        case UPLOAD_ERR_EXTENSION:
            return "Upload dihentikan oleh ekstensi PHP";
        default:
            return "Unknown upload error";
    }
}
?>