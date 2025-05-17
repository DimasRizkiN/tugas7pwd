<?php
require_once 'classes/Produk.php';
$produk = new Produk("localhost", "root", "", "produk_db");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$data = $produk->getById($id);
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    if ($produk->updateProduk($id, $nama, $harga, $deskripsi)) {
        $pesan = "✅ Produk berhasil diubah!";
        $data = $produk->getById($id); // Refresh data
    } else {
        $pesan = "❌ Gagal mengubah produk.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ubah Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 500px;
            background: #fff;
            padding: 25px 30px;
            margin: 0 auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .form-container button {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .form-container button:hover {
            background: #0056b3;
        }

        .btn-back {
            display: inline-block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-back:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 8px;
        }

        .message.success {
            background: #d4edda;
            color: #155724;
        }

        .message.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Ubah Data Produk</h1>

    <div class="form-container">
        <?php if ($pesan): ?>
            <div class="message <?= strpos($pesan, 'berhasil') !== false ? 'success' : 'error' ?>">
                <?= $pesan ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label>Nama Produk:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

            <label>Harga:</label>
            <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

            <label>Deskripsi:</label>
            <textarea name="deskripsi" rows="5" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <a href="index.php" class="btn-back">← Kembali ke Daftar Produk</a>
    </div>

    <script src="script.js" defer></script>

</body>
</html>
