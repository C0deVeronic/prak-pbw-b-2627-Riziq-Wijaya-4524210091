<?php
/**
 * Tugas Pertemuan 4 - Manipulasi Data UPDATE, GROUP BY, dan DELETE (Versi Modifikasi dari contoh2.php)
 * File: Tugas4_2.php
 */

require_once 'koneksi.php';

// Memilih database
mysqli_select_db($koneksi, 'akademik');

// Memastikan data sampel tersedia untuk dites
$sqlPrep = "INSERT IGNORE INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk) VALUES
('2025003', 'Budi Santoso', 'budi@kampus.ac.id', 'Teknik Informatika', 2025, 3.20),
('2026001', 'Andi Pratama', 'andi@kampus.ac.id', 'Teknik Informatika', 2026, 3.75),
('2026002', 'Siti Rahma', 'siti@kampus.ac.id', 'Sistem Informasi', 2026, 3.82)";
mysqli_query($koneksi, $sqlPrep);

// =========================================================================
// MODIFIKASI 1: Update Multi-Kolom & Audit Baris Terpengaruh (mysqli_affected_rows)
// =========================================================================
echo "=== 1. PROSES UPDATE DATA MULTI-KOLOM ===\n";
$sqlUpdate = "UPDATE mahasiswa SET ipk = 3.60, prodi = 'Teknik Informatika' WHERE nim = '2025003'";

if (mysqli_query($koneksi, $sqlUpdate)) {
    $barisTerubah = mysqli_affected_rows($koneksi);
    echo "[SUKSES] Data IPK mahasiswa (NIM 2025003) berhasil diperbarui menjadi 3.60.\n";
    echo "Jumlah baris data yang terpengaruh di database: " . $barisTerubah . " baris.\n\n";
} else {
    echo "[ERROR] Gagal UPDATE: " . mysqli_error($koneksi) . "\n\n";
}

// =========================================================================
// MODIFIKASI 2: Rekapitulasi Lanjutan dengan MAX/MIN IPK & HAVING Filter
// =========================================================================
echo "=== 2. REKAPITULASI MAHASISWA PER PRODI (DENGAN MAX & MIN IPK) ===\n";

$sqlRekap = "SELECT prodi, COUNT(*) AS jumlah, ROUND(AVG(ipk), 2) AS rata_ipk, MAX(ipk) AS max_ipk, MIN(ipk) AS min_ipk
             FROM mahasiswa
             GROUP BY prodi
             HAVING jumlah >= 1
             ORDER BY rata_ipk DESC";

$resultRekap = mysqli_query($koneksi, $sqlRekap);

if (mysqli_num_rows($resultRekap) > 0) {
    while ($row = mysqli_fetch_assoc($resultRekap)) {
        echo "Prodi       : " . $row['prodi'] . "\n";
        echo "Jumlah Mhs  : " . $row['jumlah'] . " Orang\n";
        echo "Rata-rata   : " . $row['rata_ipk'] . "\n";
        echo "IPK Tertinggi: " . $row['max_ipk'] . "\n";
        echo "IPK Terendah : " . $row['min_ipk'] . "\n";
        echo "----------------------------------------\n";
    }
} else {
    echo "Belum ada data rekap prodi.\n";
}
echo "\n";

// =========================================================================
// 3. VERIFIKASI & PROSES DELETE SAFE DATA
// =========================================================================
echo "=== 3. VERIFIKASI SEBELUM PENGHAPUSAN (NIM 2025003) ===\n";
$sqlVerifikasi = "SELECT * FROM mahasiswa WHERE nim = '2025003'";
$resultVerifikasi = mysqli_query($koneksi, $sqlVerifikasi);

if (mysqli_num_rows($resultVerifikasi) > 0) {
    $row = mysqli_fetch_assoc($resultVerifikasi);

    echo "Data Ditemukan!\n";
    echo "NIM  : " . $row['nim'] . "\n";
    echo "Nama : " . $row['nama'] . "\n";
    echo "Prodi: " . $row['prodi'] . "\n";
    echo "IPK  : " . $row['ipk'] . "\n\n";

    echo "=== 4. PROSES HAPUS DATA & AUDIT AKHIR ===\n";
    $sqlDelete = "DELETE FROM mahasiswa WHERE nim = '2025003'";

    if (mysqli_query($koneksi, $sqlDelete)) {
        echo "[SUKSES] Data mahasiswa (NIM 2025003) berhasil dihapus dari database.\n";
    } else {
        echo "[ERROR] Gagal menghapus data: " . mysqli_error($koneksi) . "\n";
    }
} else {
    echo "Data mahasiswa dengan NIM 2025003 TIDAK DITEMUKAN (mungkin sudah terhapus sebelumnya).\n";
}

// Audit Jumlah Sisa Data Mahasiswa di Database
$sqlCountSisa = "SELECT COUNT(*) as sisa_mhs FROM mahasiswa";
$resCount = mysqli_query($koneksi, $sqlCountSisa);
$sisa = mysqli_fetch_assoc($resCount);
echo "Total sisa mahasiswa terdaftar saat ini: " . $sisa['sisa_mhs'] . " Orang.\n";

mysqli_close($koneksi);
?>
