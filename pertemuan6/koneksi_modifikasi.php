<?php
$host     = '127.0.0.1';
$user     = 'root';
$password = '';
$dbname   = 'akademik1';

// Melakukan koneksi ke database MySQL
$koneksi = mysqli_connect($host, $user, $password, $dbname);

// Penanganan kegagalan koneksi
if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

// MODIFIKASI 1: Menetapkan character set ke UTF-8 (utf8mb4) agar mendukung semua karakter teks khusus dengan baik
mysqli_set_charset($koneksi, "utf8mb4");

// MODIFIKASI 2: Output status koneksi kondisional
// Pesan sukses hanya ditampilkan jika file ini diakses/diuji secara langsung (bukan saat di-include oleh halaman lain),
// sehingga tidak mengotori header/tampilan halaman seperti index.php atau create.php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    echo "<div style='font-family: sans-serif; padding: 20px; background: #e6ffed; border: 1px solid #52c41a; border-radius: 6px; color: #135200; max-width: 500px; margin: 30px auto;'>";
    echo "<h3 style='margin-top: 0;'>✔ Status Koneksi Database</h3>";
    echo "<p>Koneksi ke database <strong>$dbname</strong> di host <strong>$host</strong> berhasil!</p>";
    echo "</div>";
}
?>
