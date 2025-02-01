<?php
header("Content-Type: application/json");

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal", "icon" => "fa-regular fa-xmark"]));
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["folder_baru"]) && !empty(trim($data["folder_baru"]))) {
    $folder_name = $conn->real_escape_string($data["folder_baru"]);
    $date = date("Y-m-d H:i:s");
    
    // Cek apakah folder sudah ada
    $check_sql = "SELECT * FROM folder WHERE folder_name = '$folder_name'";
    $result = $conn->query($check_sql);
    
    if ($result->num_rows > 0) {
        echo json_encode(["status" => "exists", "message" => "Folder sudah ada", "icon" => "fa-regular fa-exclamation"]);
    } else {
        $sql = "INSERT INTO folder (folder_name, date) VALUES ('$folder_name', '$date')";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Folder berhasil disimpan", "icon" => "fa-regular fa-circle-check"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan folder", "icon" => "fa-regular fa-xmark"]);
        }
    }
} else {
    echo json_encode(["status" => "error", "message" => "Nama folder tidak boleh kosong", "icon" => "fa-regular fa-xmark"]);
}

$conn->close();