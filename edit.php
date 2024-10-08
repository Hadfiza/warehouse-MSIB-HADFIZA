<?php
require_once 'database.php';
require_once 'gudang.php';

// Koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek pelanggan
$gudang = new gudang($db);

// Mendapatkan ID pelanggan dari URL
$gudang->id = isset($_GET['id']) ? $_GET['id'] : die('Error: ID tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour =$_POST['closing_hour'];
    
    if ($gudang->update()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengupdate pelanggan.";
    }
} else {
    // Mendapatkan data pelanggan berdasarkan ID
    $stmt = $gudang->show($gudang->id);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    /* var_dump($data);
    exit; */

    $gudang->name = $data['name'];
    $gudang->location = $data['location'];
    $gudang->capacity = $data['capacity'];
    $gudang->status = $data['status'];
    $gudang->opening_hour = $data['opening_hour'];
    $gudang->closing_hour = $data['closing_hour'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pelanggan</h1>

    <form action="edit.php?id=<?php echo $gudang->id; ?>" method="POST">
        <div class="mb-2">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" required><br>
        </div>

        <div class="mb-2">
            <label for="location">Lokasi:</label>
            <input type="text" class="form-control" name="location" id="location" required><br>
        </div>

        <div class="mb-2">
            <label for="capacity">Kapasitas:</label>
            <input type="text" class="form-control" name="capacity" id="capacity" required><br><br>
        </div>

        <div class="mb-2">
            <label for="status">Status:</label>
            <input type="text" class="form-control" name="status" id="status" required><br><br>
        </div>

        <div class="mb-2">
            <label for="opening_hour">Waktu Buka:</label>
            <input type="time" class="form-control" name="opening_hour" id="opening_hour" required><br><br>
        </div>

        <div class="mb-2">
            <label for="closing_hour">Waktu Tutup:</label>
            <input type="time" class="form-control" name="closing_hour" id="closing_hour" required><br><br>
        </div>

        <input type="submit" class="btn btn-warning w-100" value="Update Pelanggan">
    </form>

    <br>
    <a href="index.php">Kembali ke List Gudang</a>
    </div>
</body>
</html>
