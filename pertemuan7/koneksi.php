<?php
$host     = '127.0.0.1';
$user     = 'root';
$password = '';
$dbname   = 'db_penjualan';

// Hubungkan ke server MySQL
$koneksi = mysqli_connect($host, $user, $password);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Inisialisasi database dan tabel jika belum ada
mysqli_query($koneksi, "CREATE DATABASE IF NOT EXISTS `$dbname`");
mysqli_select_db($koneksi, $dbname);
mysqli_set_charset($koneksi, "utf8mb4");

$queryTable = "CREATE TABLE IF NOT EXISTS `produk` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_produk` VARCHAR(150) NOT NULL,
    `harga` DECIMAL(12, 2) NOT NULL,
    `stok` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($koneksi, $queryTable);
?>
