<?php
header("Content-Type: application/json");
include 'config.php';

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;

// Log folder_id yang diterima
error_log("Received folder_id: " . $folder_id);

if (!$folder_id) {
    echo json_encode(["status" => "error", "message" => "ID Folder tidak valid"]);
    exit;
}

try {
    // Ubah query untuk mengambil file_path yang berisi nama file yang benar
    $sql = "SELECT f.id, f.file_path, f.title, f.desc, f.date 
            FROM foto f 
            WHERE f.folder_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $folder_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $photos = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Ambil nama file dari file_path
            $file_name = basename($row['file_path']); // Ini akan mengambil '679c73867eab3.png' dari path lengkap
            
            $photos[] = [
                'id' => $row['id'],
                'file_name' => $file_name, // Gunakan nama file yang benar
                'title' => $row['title'],
                'desc' => $row['desc'],
                'date' => $row['date']
            ];
        }
        
        // Log untuk debugging
        error_log("Found photos: " . print_r($photos, true));
        
        echo json_encode([
            "status" => "success",
            "photos" => $photos,
            "debug_info" => [
                "folder_id" => $folder_id,
                "photo_count" => count($photos)
            ]
        ]);
    } else {
        echo json_encode([
            "status" => "empty", 
            "message" => "Tidak ada foto dalam folder ini",
            "debug_info" => ["folder_id" => $folder_id]
        ]);
    }

    $stmt->close();
} catch (Exception $e) {
    error_log("Error in get_photos.php: " . $e->getMessage());
    echo json_encode([
        "status" => "error",
        "message" => "Terjadi kesalahan saat mengambil data foto",
        "debug_info" => $e->getMessage()
    ]);
}

$conn->close();
?>