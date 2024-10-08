<?php

class Database {
    private $host = "localhost";
    private $port = "3308";
    private $db_name = "warehouse_msib";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            // Menggunakan $this->conn untuk menyimpan objek PDO
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
            // Set mode kesalahan PDO menjadi exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully"; // Anda dapat menghapus ini setelah pengujian
        } catch(PDOException $error) {
            // echo "Connection failed: " . $error->getMessage();
        }

        return $this->conn; // Mengembalikan koneksi yang telah disimpan
    }
}

// // Membuat objek Database dan mendapatkan koneksi
// $database = new Database();
// $database->getConnection();
?>
