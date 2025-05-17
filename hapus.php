<?php
require_once 'classes/Produk.php';
$produk = new Produk("localhost", "root", "", "produk_db");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produk->hapusProduk($id);
}
header("Location: index.php");
exit;
