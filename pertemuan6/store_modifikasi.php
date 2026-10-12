<?php
include "koneksi_modifikasi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // MODIFIKASI 1: Sanitasi input untuk mencegah celah keamanan (SQL Injection & whitespace)
    $nim      = mysqli_real_escape_string($koneksi, trim($_POST['nim'] ?? ''));
    $nama     = mysqli_real_escape_string($koneksi, trim($_POST['nama'] ?? ''));
    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $prodi    = mysqli_real_escape_string($koneksi, trim($_POST['prodi'] ?? ''));
    $angkatan = mysqli_real_escape_string($koneksi, trim($_POST['angkatan'] ?? ''));
    $ipk      = (float) ($_POST['ipk'] ?? 0);

    // Validasi kelengkapan form
    if (empty($nim) || empty($nama) || empty($email) || empty($prodi) || empty($angkatan)) {
        echo "<script>
                alert('Semua bidang wajib diisi!');
                window.history.back();
              </script>";
        exit;
    }

    // MODIFIKASI 2: Pengecekan duplikasi NIM (Primary Key) sebelum INSERT
    // Mencegah error database jika NIM sudah digunakan oleh mahasiswa lain
    $cek_nim = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
    if (mysqli_num_rows($cek_nim) > 0) {
        echo "<script>
                alert('Peringatan: Mahasiswa dengan NIM $nim sudah terdaftar!');
                window.history.back();
              </script>";
        exit;
    }

    // Validasi range IPK
    if ($ipk < 0 || $ipk > 4.00) {
        echo "<script>
                alert('Nilai IPK tidak valid! Harus antara 0.00 hingga 4.00');
                window.history.back();
              </script>";
        exit;
    }

    // Eksekusi penyimpanan data
    $query = mysqli_query(
        $koneksi,
        "INSERT INTO mahasiswa
        (nim, nama, email, prodi, angkatan, ipk)
        VALUES
        ('$nim', '$nama', '$email',
        '$prodi', '$angkatan', '$ipk')"
    );

    if ($query) {
        echo "<script>
                alert('Data mahasiswa: $nama ($nim) berhasil disimpan!');
                window.location.href = 'index_modifikasi.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal disimpan: " . addslashes(mysqli_error($koneksi)) . "');
                window.history.back();
              </script>";
    }
} else {
    // Jika file diakses langsung tanpa submit form POST
    header("Location: index_modifikasi.php");
    exit;
}
?>
