<?php
require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001','Andi Pratama','andi@kampus.ac.id','Teknik Informatika',2026,3.75),
('2026002','Siti Rahma','siti@kampus.ac.id','Sistem Informasi',2026,3.82),
('2025003','Budi Santoso','budi@kampus.ac.id','Teknik Informatika',2025,3.20)";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukkan ke tabel.\n\n";
} else {
    echo "[ERROR] Gagal memasukkan data: " . mysqli_error($koneksi) . "\n\n";
}

// Modifikasi 2 (Bagian A): Query utama SELECT dengan kriteria IPK >= 3.50
$sqlSelect = "SELECT nim, nama, prodi, ipk
              FROM mahasiswa
              WHERE ipk >= 3.50
              ORDER BY ipk DESC, nama ASC
              LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

// Modifikasi 2 (Bagian B): Query tambahan untuk menghitung statistik (Total & Rata-rata IPK)
$sqlStats = "SELECT COUNT(*) as total_mhs, AVG(ipk) as rata_ipk FROM mahasiswa WHERE ipk >= 3.50";
$resultStats = mysqli_query($koneksi, $sqlStats);
$stats = mysqli_fetch_assoc($resultStats);

echo "--- STATISTIK MAHASISWA BERPRESTASI ---\n";
echo "Jumlah Mahasiswa (IPK >= 3.50): " . $stats['total_mhs'] . "\n";
echo "Rata-rata IPK                  : " . number_format($stats['rata_ipk'], 2) . "\n\n";

echo "--- HASIL QUERY SELECT & VALIDASI PREDIKAT ---\n";
if (mysqli_num_rows($result) > 0) {
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        // Modifikasi 1: Validasi/Kondisi baru untuk menentukan predikat berdasarkan IPK
        $predikat = ($row['ipk'] >= 3.80) ? "Cumlaude (Dengan Pujian)" : "Sangat Memuaskan";

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