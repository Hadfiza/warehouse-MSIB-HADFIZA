<?php
include_once 'database.php';
include_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

// Memeriksa koneksi
if ($db === null) {
    die("Koneksi ke database gagal!");
}

$query = "SELECT * FROM gudang"; 

if (isset($_POST["submit"])) {
    $cari = "%{$_POST["cari"]}%";
    $query = "SELECT * FROM gudang WHERE name LIKE :cari";
}

// Mempersiapkan dan mengeksekusi query
$stmt = $db->prepare($query);

if (isset($_POST["submit"])) {
    $stmt->bindParam(':cari', $cari);
    $cari = "%$cari%";
}

$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warehouse MSIB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body >
    <h2 class="mt-4 text-center">Daftar Gudang</h2>
    <div class="container mt-5 border shadow rounded mb-5 pt-5 min-vh-100">
        

        <form action="" method="POST" style="display : flex; justify-content: end;">
            <input type="text" placeholder="Cari Nama Gudang" name="cari">
            <button type="submit" name="submit" style="margin-left: 1%;">Cari</button>
        </form>
        <br>
        <button style="margin : 0px 0px 2rem 62.7rem;"><a href="create.php" style="text-decoration: none; color: black;">Tambah Data</a></button>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['location'] ?></td>
                        <td><?= $row['capacity'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td><?= $row['opening_hour'] ?></td>
                        <td><?= $row['closing_hour'] ?></td>
                        <td>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                            <?php if ($row['status'] === 'aktif'): ?>
                            <!-- Tombol Nonaktifkan -->
                            <a href="status.php?id=<?= $row['id'] ?>&status=tidak_aktif" class="btn btn-secondary btn-sm">Nonaktifkan</a>
                            <?php else: ?>
                                <!-- Tombol Aktifkan -->
                            <a href="status.php?id=<?= $row['id'] ?>&status=aktif" class="btn btn-success btn-sm">Aktifkan</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <footer class="bg-light text-center text-lg-start mt-auto ">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2024 Warehouse MSIB:HADFIZA
    </div>
    </footer>

</body>
</html>
