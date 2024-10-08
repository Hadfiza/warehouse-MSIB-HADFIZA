<?php
require_once 'database.php';
require_once 'gudang.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek gudang
$gudang = new gudang($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];
   
    if ($gudang->create()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambah gudang.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Gudang</h1>

        <form action="create.php" method="POST">
            <div class="mb-2">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-2">
                <label for="location">Lokasi:</label>
                <input type="text" class="form-control" name="location" id="location" required>
            </div>

            <div class="mb-2">
                <label for="capacity">Kapasitas:</label>
                <input type="text" class="form-control" name="capacity" id="capacity" required>
            </div>

            <div class="mb-2">
                <label for="status">Status:</label>
                <input type="text" class="form-control" name="status" id="status" required>
            </div>

            <div class="mb-2">
                <label for="opening_hour">Waktu Buka:</label>
                <input type="time" class="form-control" name="opening_hour" id="opening_hour" required>
            </div>

            <div class="mb-2">
                <label for="closing_hour">Waktu Tutup:</label>
                <input type="time" class="form-control" name="closing_hour" id="closing_hour" required>
            </div>

            <input type="submit" class="btn btn-primary w-100" value="Tambah Gudang">
        </form>

        <br>
        <a href="index.php">Kembali ke Daftar Gudang</a>
    </div>
</body>
</html>
