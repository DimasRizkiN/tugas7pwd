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

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
    }

    public function updateProduk($id, $nama, $harga, $deskripsi) {
        $stmt = $this->conn->prepare("UPDATE produk SET nama=?, harga=?, deskripsi=? WHERE id=?");
        $stmt->bind_param("sdsi", $nama, $harga, $deskripsi, $id);
            return $stmt->execute();
    }

    public function hapusProduk($id) {
        $stmt = $this->conn->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bind_param("i", $id);
            return $stmt->execute();
    }

}
?>
