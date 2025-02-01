<?php
header("Content-Type: application/json");
include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal"]));
}

$sql = "SELECT folder_id, folder_name FROM folder ORDER BY folder_name ASC";
$result = $conn->query($sql);

$folders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $folders[] = $row;
    }
    echo json_encode(["status" => "success", "folders" => $folders]);
} else {
    echo json_encode(["status" => "empty", "message" => "Tidak ada folder tersedia"]);
}

$conn->close();