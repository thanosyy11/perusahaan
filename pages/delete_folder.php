<?php
header('Content-Type: application/json');
include 'config.php';

// Terima data JSON
$data = json_decode(file_get_contents('php://input'), true);
$folder_id = $data['folder_id'] ?? null;

try {
    // Mulai transaksi
    $conn->begin_transaction();

    // Ambil semua foto dalam folder
    $stmt = $conn->prepare("SELECT file_name FROM foto WHERE folder_id = ?");
    $stmt->bind_param("i", $folder_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Hapus file foto dari folder uploads
    while ($row = $result->fetch_assoc()) {
        $file_path = "../uploads/" . $row['file_name'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Hapus semua foto dari database
    $stmt = $conn->prepare("DELETE FROM foto WHERE folder_id = ?");
    $stmt->bind_param("i", $folder_id);
    $stmt->execute();

    // Hapus folder dari database
    $stmt = $conn->prepare("DELETE FROM folder WHERE folder_id = ?");
    $stmt->bind_param("i", $folder_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Commit transaksi
        $conn->commit();

        echo json_encode([
            "status" => "success",
            "message" => "Folder dan semua foto berhasil dihapus"
        ]);
    } else {
        throw new Exception("Folder tidak ditemukan");
    }

} catch (Exception $e) {
    // Rollback jika terjadi error
    $conn->rollback();
    
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?> 