<?php
header('Content-Type: application/json');
include 'config.php';

// Terima data JSON
$data = json_decode(file_get_contents('php://input'), true);
$photo_id = $data['photo_id'] ?? null;
$description = $data['description'] ?? null;

try {
    // Update deskripsi di database
    $stmt = $conn->prepare("UPDATE foto SET `desc` = ? WHERE id = ?");
    $stmt->bind_param("si", $description, $photo_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode([
            "status" => "success",
            "message" => "Deskripsi berhasil diupdate"
        ]);
    } else {
        throw new Exception("Foto tidak ditemukan");
    }

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?> 