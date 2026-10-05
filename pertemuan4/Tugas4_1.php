<?php
/**
 * Tugas Pertemuan 4 - Manipulasi Data MySQL (Versi Modifikasi dari contoh1.php)
 * File: Tugas4_1.php
 */

require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

// Memasukkan data mahasiswa awal
$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001','Andi Pratama','andi@kampus.ac.id','Teknik Informatika',2026,3.75),
('2026002','Siti Rahma','siti@kampus.ac.id','Sistem Informasi',2026,3.82),
('2025003','Budi Santoso','budi@kampus.ac.id','Teknik Informatika',2025,3.20),
('2026004','Lina Permata','lina@kampus.ac.id','Sistem Informasi',2026,3.65)";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukkan/diperbarui.\n\n";
} else {
    echo "[ERROR] Gagal memasukkan data: " . mysqli_error($koneksi) . "\n\n";
}

// Query utama SELECT dengan kriteria IPK >= 3.50
$sqlSelect = "SELECT nim, nama, prodi, ipk
              FROM mahasiswa
              WHERE ipk >= 3.50
              ORDER BY ipk DESC, nama ASC
              LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

// =========================================================================
// MODIFIKASI 2: Query Statistik Lengkap (Total, Rata-rata, Max, Min IPK)
// =========================================================================
$sqlStats = "SELECT COUNT(*) as total_mhs, AVG(ipk) as rata_ipk, MAX(ipk) as max_ipk, MIN(ipk) as min_ipk 
             FROM mahasiswa WHERE ipk >= 3.50";
$resultStats = mysqli_query($koneksi, $sqlStats);
$stats = mysqli_fetch_assoc($resultStats);

echo "--- STATISTIK MAHASISWA BERPRESTASI (IPK >= 3.50) ---\n";
echo "Jumlah Mahasiswa : " . $stats['total_mhs'] . " Orang\n";
echo "Rata-rata IPK    : " . number_format($stats['rata_ipk'], 2) . "\n";
echo "IPK Tertinggi    : " . number_format($stats['max_ipk'], 2) . "\n";
echo "IPK Terendah     : " . number_format($stats['min_ipk'], 2) . "\n\n";

echo "--- HASIL QUERY SELECT & VALIDASI PREDIKAT --- \n";
if (mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // =========================================================================
        // MODIFIKASI 1: Validasi Multi-Tingkat Predikat Kelulusan Berdasarkan IPK
        // =========================================================================
        if ($row['ipk'] >= 3.80) {
            $predikat = "Cumlaude (Dengan Pujian)";
        } else if ($row['ipk'] >= 3.50) {
            $predikat = "Sangat Memuaskan";
        } else if ($row['ipk'] >= 3.00) {
            $predikat = "Memuaskan";
        } else {
            $predikat = "Cukup";
        }

        echo "Data ke-" . $no++ . "\n";
        echo "NIM     : " . $row['nim'] . "\n";
        echo "Nama    : " . $row['nama'] . "\n";
        echo "Prodi   : " . $row['prodi'] . "\n";
        echo "IPK     : " . $row['ipk'] . "\n";
        echo "Predikat: " . $predikat . "\n";
        echo "----------------------------------------\n";
    }
} else {
    echo "Tidak ada data mahasiswa dengan kriteria tersebut.\n";
}

mysqli_close($koneksi);
?>
