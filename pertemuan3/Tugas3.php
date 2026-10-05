<?php
/**
 * Tugas Pertemuan 3 - Pengelolaan Database dan Tabel MySQL (Versi Modifikasi dari contoh1.php)
 * File: Tugas3.php
 */

require_once 'Tugas3_koneksi.php';

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik";

if (mysqli_query($koneksi, $sqlCreateDB)) {
    echo "Database 'akademik' berhasil dibuat atau sudah ada.\n";
} else {
    echo "Error membuat database: " . mysqli_error($koneksi) . "\n";
}

mysqli_set_charset($koneksi, "utf8mb4");

mysqli_select_db($koneksi, 'akademik');

// =========================================================================
// MODIFIKASI 1: Penambahan field baru (status_aktif & created_at) pada tabel mahasiswa
// =========================================================================
$sqlCreateTables = [
    "CREATE TABLE IF NOT EXISTS mahasiswa (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nim VARCHAR(15) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(120) NOT NULL UNIQUE,
        prodi VARCHAR(80) NOT NULL,
        angkatan YEAR NOT NULL,
        ipk DECIMAL(3,2) DEFAULT 0.00,
        status_aktif ENUM('Aktif', 'Cuti', 'Lulus') DEFAULT 'Aktif',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS dosen (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nidn VARCHAR(20) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(120) NOT NULL UNIQUE
    ) ENGINE=InnoDB",

    "CREATE TABLE IF NOT EXISTS mata_kuliah (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        kode_mk VARCHAR(12) NOT NULL UNIQUE,
        nama_mk VARCHAR(100) NOT NULL,
        sks TINYINT UNSIGNED NOT NULL,
        dosen_id BIGINT UNSIGNED,
        CONSTRAINT fk_mk_dosen
        FOREIGN KEY (dosen_id) REFERENCES dosen(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
    ) ENGINE=InnoDB"
];

echo "\n--- PROSES MEMBUAT TABEL ---\n";
foreach ($sqlCreateTables as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "[SUKSES] Tabel berhasil dibuat atau sudah ada.\n";
    } else {
        echo "[ERROR] Gagal membuat tabel: " . mysqli_error($koneksi) . "\n";
    }
}

// =========================================================================
// MODIFIKASI 2: Query verifikasi dan rekapitulasi jumlah tabel dalam database akademik
// =========================================================================
$sqlShowTables = "SHOW TABLES FROM akademik";
$resultTables = mysqli_query($koneksi, $sqlShowTables);

if ($resultTables) {
    $totalTabel = mysqli_num_rows($resultTables);
    echo "\n--- VERIFIKASI STRUKTUR DATABASE ---\n";
    echo "Total tabel terverifikasi di database 'akademik': " . $totalTabel . " tabel.\n";
    while ($row = mysqli_fetch_array($resultTables)) {
        echo "- Tabel: " . $row[0] . "\n";
    }
}

mysqli_close($koneksi);
?>
