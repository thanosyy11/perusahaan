<?php
header('Content-Type: application/json');
include 'config.php';

// Terima data JSON
$data = json_decode(file_get_contents('php://input'), true);
$photo_id = $data['photo_id'] ?? null;
$file_name = $data['file_name'] ?? null;

try {
    // Mulai transaksi
    $conn->begin_transaction();

    // Hapus dari database
    $stmt = $conn->prepare("DELETE FROM foto WHERE id = ?");
    $stmt->bind_param("i", $photo_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Hapus file dari folder uploads
        $file_path = "../uploads/" . $file_name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Commit transaksi
        $conn->commit();

        echo json_encode([
            "status" => "success",
            "message" => "Foto berhasil dihapus"
        ]);
    } else {
        throw new Exception("Foto tidak ditemukan");
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