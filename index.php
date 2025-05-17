<?php
require_once 'classes/Produk.php';

$produk = new Produk("localhost", "root", "", "produk_db");
$data = $produk->getAllProduk();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Produk</h1>
    <div class="produk-container">
        <?php foreach ($data as $item): ?>
            <div class="produk-card">
                <h2><?= htmlspecialchars($item['nama']) ?></h2>
                <p><?= htmlspecialchars($item['deskripsi']) ?></p>
                <strong>Rp <?= number_format($item['harga'], 0, ',', '.') ?></strong>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
