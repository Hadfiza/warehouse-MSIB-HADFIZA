<?php
include_once 'database.php';
include_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

// Memeriksa apakah ID dan status baru telah diterima
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Query untuk memperbarui status
    $query = "UPDATE gudang SET status = :status WHERE id = :id";
    $stmt = $db->prepare($query);
    
    // Mengikat parameter
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':status', $status);

    // Menjalankan query
    if ($stmt->execute()) {
        // Mengalihkan kembali ke halaman index.php
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah status.";
    }
} else {
    echo "ID atau status tidak ditemukan.";
}
?>
