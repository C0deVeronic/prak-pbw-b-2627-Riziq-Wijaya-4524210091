<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak diizinkan. Silakan isi form terlebih dahulu.");
}

$nim = trim($_POST['nim'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = trim($_POST['prodi'] ?? '');
$angkatan = (int) ($_POST['angkatan'] ?? 0);
$ipk = (float) ($_POST['ipk'] ?? 0);

$cek = mysqli_query($koneksi, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
if (mysqli_num_rows($cek) > 0) {
    echo "<h3>Gagal: NIM $nim sudah terdaftar di database!</h3>";
    echo "<a href='Tugas1.php'>Kembali ke Form</a> | <a href='data.php'>Lihat Data</a>";
    exit;
}

$query = mysqli_query(
    $koneksi,
    "INSERT INTO mahasiswa (nim, nama, email, prodi, angkatan, ipk)
    VALUES ('$nim', '$nama', '$email', '$prodi', $angkatan, $ipk)"
);

if ($query) {
    echo "<h3>Data mahasiswa berhasil disimpan!</h3>";
    echo "<ul>
        <li>NIM: $nim</li>
        <li>Nama: $nama</li>
        <li>Email: $email</li>
        <li>Prodi: $prodi</li>
        <li>Angkatan: $angkatan</li>
        <li>IPK: $ipk</li>
    </ul>";
} else {
    echo "<h3>Data gagal disimpan: " . mysqli_error($koneksi) . "</h3>";
}

echo "<br><a href='Tugas1.php'>Tambah Data Lagi</a> | <a href='data.php'>Lihat Semua Data</a>";
?>
