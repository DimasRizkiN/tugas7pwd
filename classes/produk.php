<?php
class Produk {
    private $conn;

    public function __construct($host, $user, $pass, $db) {
        $this->conn = new mysqli($host, $user, $pass, $db);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getAllProduk() {
        $sql = "SELECT * FROM produk";
        $result = $this->conn->query($sql);

        $produk = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produk[] = $row;
            }
        }
        return $produk;
    }
}
?>
