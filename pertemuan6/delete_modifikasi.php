<?php
include "koneksi_modifikasi.php";

// MODIFIKASI 1: Validasi parameter NIM dan sanitasi input untuk keamanan
if (!isset($_GET['nim']) || empty(trim($_GET['nim']))) {
    echo "<script>
            alert('NIM tidak ditemukan atau tidak valid!');
            window.location.href = 'index_modifikasi.php';
          </script>";
    exit;
}

$nim = mysqli_real_escape_string($koneksi, trim($_GET['nim']));

// MODIFIKASI 2: Mengambil data nama mahasiswa terlebih dahulu agar alert lebih informatif
$cek = mysqli_query($koneksi, "SELECT nama FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_assoc($cek);

if ($data) {
    $nama = $data['nama'];

    $query = mysqli_query(
        $koneksi,
        "DELETE FROM mahasiswa WHERE nim='$nim'"
    );

    if ($query) {
        echo "<script>
                alert('Data mahasiswa: $nama ($nim) berhasil dihapus');
                window.location.href = 'index_modifikasi.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Data mahasiswa tidak ditemukan di database!');
            window.location.href = 'index_modifikasi.php';
          </script>";
}
?>
