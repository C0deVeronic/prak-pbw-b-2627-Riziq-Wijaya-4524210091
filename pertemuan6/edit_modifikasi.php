<?php
include "koneksi_modifikasi.php";

// Validasi parameter NIM dan sanitasi input
if (!isset($_GET['nim']) || empty(trim($_GET['nim']))) {
    echo "<script>
            alert('NIM tidak ditemukan atau tidak valid!');
            window.location.href = 'index_modifikasi.php';
          </script>";
    exit;
}

$nim = mysqli_real_escape_string($koneksi, trim($_GET['nim']));

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM mahasiswa WHERE nim = '$nim'"
);

$data = mysqli_fetch_assoc($query);

// Validasi jika data mahasiswa tidak ada di database
if (!$data) {
    echo "<script>
            alert('Data mahasiswa tidak ditemukan!');
            window.location.href = 'index_modifikasi.php';
          </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Ubah Data <?= htmlspecialchars($data['nama']) ?> (Modifikasi)</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <form action="update_modifikasi.php" method="POST" 
        class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Ubah Data Mahasiswa
        </h2>
        
        <!-- MODIFIKASI 1: NIM dibuat readonly (Primary Key) agar tidak bisa diubah sehingga query WHERE nim='$nim' di update.php tetap aman -->
        <label for="nim" class="text-sm font-semibold mb-1">NIM (Primary Key - Tidak Dapat Diubah):</label>
        <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" readonly 
            class="mb-4 p-2 border border-gray-300 rounded bg-gray-100 cursor-not-allowed text-gray-600 focus:outline-none">
        
        <label for="nama" class="text-sm font-semibold mb-1">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required 
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">
        
        <label for="email" class="text-sm font-semibold mb-1">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required 
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">
        
        <!-- MODIFIKASI 2: Input Prodi diubah menjadi dropdown <select> dengan opsi otomatis terpilih (selected) sesuai data yang ada -->
        <label for="prodi" class="text-sm font-semibold mb-1">Prodi:</label>
        <select id="prodi" name="prodi" required 
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500 bg-white">
            <?php
            $daftar_prodi = ["Teknik Informatika", "Sistem Informasi", "Teknik Elektro", "Teknik Industri", "Teknik Mesin"];
            foreach ($daftar_prodi as $prodi_pilihan) :
                $terpilih = ($data['prodi'] == $prodi_pilihan) ? 'selected' : '';
            ?>
                <option value="<?= $prodi_pilihan ?>" <?= $terpilih ?>><?= $prodi_pilihan ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="angkatan" class="text-sm font-semibold mb-1">Angkatan:</label>
        <input type="number" id="angkatan" name="angkatan" value="<?= htmlspecialchars($data['angkatan']) ?>" min="2000" max="2099" required 
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">
        
        <label for="ipk" class="text-sm font-semibold mb-1">IPK (0.00 - 4.00):</label>
        <input type="number" id="ipk" name="ipk" value="<?= htmlspecialchars($data['ipk']) ?>" step="0.01" min="0" max="4.00" required 
            class="mb-6 p-2 border border-gray-300 rounded focus:outline-blue-500">
        
        <!-- Tombol Aksi: Simpan Perubahan dan Batal -->
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition cursor-pointer">
                Simpan Perubahan
            </button>
            <a href="index_modifikasi.php" class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 rounded transition">
                Batal
            </a>
        </div>
    </form>

</body>
</html>
