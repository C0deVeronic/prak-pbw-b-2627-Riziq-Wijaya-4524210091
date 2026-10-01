<?php
require_once 'koneksi.php';

mysqli_select_db($koneksi, 'akademik');

$sqlInsert = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2026001', 'Andi Pratama', 'andi@example.ac.id', 'Teknik Informatika', 2025, 3.75),
('2026002', 'Siti Rahma', 'siti@example.ac.id', 'Sistem Informasi', 2026, 3.80),
('2026003', 'Budi Santoso', 'budi@example.ac.id', 'Teknik Informatika', 2025, 3.25),
('2026004', 'Lina Permata', 'lina@example.ac.id', 'Sistem Informasi', 2026, 3.20);";

if (mysqli_query($koneksi, $sqlInsert)) {
    echo "[INSERT] Data mahasiswa berhasil dimasukkan ke tabel.\n";
} else {
    echo "[ERROR] Gagal memasukkan data: " . mysqli_error($koneksi) . "\n";
}

$sqlSelect = "SELECT nim, nama, prodi, ipk
              FROM mahasiswa
              WHERE ipk >= 3.50
              ORDER BY ipk DESC, nama ASC
              LIMIT 10";

$result = mysqli_query($koneksi, $sqlSelect);

echo "--- HASIL QUERY SELECT ---\n";
// Cek apakah ada data yang memenuhi kriteria (IPK >= 3.50)
if (mysqli_num_rows($result) > 0) {
    // Karena menggunakan LIMIT 1, loop ini hanya akan berjalan 1 kali (menampilkan Siti Rahma)
    while ($row = mysqli_fetch_assoc($result)) {
        echo "NIM  : " . $row['nim'] . "\n";
        echo "Nama : " . $row['nama'] . "\n";
        echo "Prodi: " . $row['prodi'] . "\n";
        echo "IPK  : " . $row['ipk'] . "\n";
    }
} else {
    echo "Tidak ada data mahasiswa dengan kriteria tersebut.\n";
}

mysqli_close($koneksi);