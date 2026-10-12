<?php
include "koneksi_modifikasi.php";

// MODIFIKASI 1: Validasi metode request POST dan sanitasi input
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nim      = mysqli_real_escape_string($koneksi, trim($_POST['nim'] ?? ''));
    $nama     = mysqli_real_escape_string($koneksi, trim($_POST['nama'] ?? ''));
    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email'] ?? ''));
    $prodi    = mysqli_real_escape_string($koneksi, trim($_POST['prodi'] ?? ''));
    $angkatan = mysqli_real_escape_string($koneksi, trim($_POST['angkatan'] ?? ''));
    $ipk      = (float) ($_POST['ipk'] ?? 0);

    // Validasi kelengkapan form
    if (empty($nim) || empty($nama) || empty($email) || empty($prodi) || empty($angkatan)) {
        echo "<script>
                alert('Semua bidang data wajib diisi!');
                window.history.back();
              </script>";
        exit;
    }

    // Validasi batasan IPK
    if ($ipk < 0 || $ipk > 4.00) {
        echo "<script>
                alert('Nilai IPK tidak valid! Harus antara 0.00 hingga 4.00');
                window.history.back();
              </script>";
        exit;
    }

    // MODIFIKASI 2: Pengecekan keberadaan data di database sebelum eksekusi update
    $cek = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
    if (mysqli_num_rows($cek) == 0) {
        echo "<script>
                alert('Data mahasiswa dengan NIM $nim tidak ditemukan!');
                window.location.href = 'index_modifikasi.php';
              </script>";
        exit;
    }

    // Eksekusi update data
    $query = mysqli_query(
        $koneksi,
        "UPDATE mahasiswa
        SET nama='$nama',
            email='$email',
            prodi='$prodi',
            angkatan='$angkatan',
            ipk='$ipk'
        WHERE nim='$nim'"
    );

    if ($query) {
        echo "<script>
                alert('Data mahasiswa: $nama ($nim) berhasil diperbarui!');
                window.location.href = 'index_modifikasi.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diperbarui: " . addslashes(mysqli_error($koneksi)) . "');
                window.history.back();
              </script>";
    }
} else {
    // Jika diakses langsung tanpa method POST
    header("Location: index_modifikasi.php");
    exit;
}
?>
