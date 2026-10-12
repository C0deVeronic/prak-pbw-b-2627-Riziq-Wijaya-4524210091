<?php
include "koneksi_modifikasi.php";

// MODIFIKASI 1: Fitur Pencarian berdasarkan NIM atau Nama
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, trim($_GET['cari'])) : '';

if (!empty($cari)) {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim LIKE '%$cari%' OR nama LIKE '%$cari%' ORDER BY nim ASC");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim ASC");
}

$total_data = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa (Modifikasi)</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <div class="max-w-5xl mx-auto bg-white shadow-md p-6 rounded-lg">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Data Mahasiswa</h2>
                <p class="text-sm text-gray-500">Total data: <span class="font-semibold text-blue-600"><?= $total_data ?></span> mahasiswa</p>
            </div>
            
            <a href="create_modifikasi.php"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition text-center">
                + Tambah Mahasiswa
            </a>
        </div>

        <!-- MODIFIKASI 1: Form Pencarian -->
        <form action="" method="GET" class="mb-4 flex gap-2">
            <input type="text" name="cari" value="<?= htmlspecialchars($cari) ?>"
                   placeholder="Cari berdasarkan NIM atau Nama..."
                   class="flex-1 p-2 border border-gray-300 rounded focus:outline-blue-500">
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded transition cursor-pointer">
                Cari
            </button>
            <?php if (!empty($cari)) : ?>
                <a href="index_modifikasi.php" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition flex items-center">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        <!-- Tabel Data -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <!-- MODIFIKASI 2: Penambahan kolom nomor urut (No) -->
                        <th class="border border-gray-200 p-3 font-semibold text-center w-12">No</th>
                        <th class="border border-gray-200 p-3 font-semibold">NIM</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                        <th class="border border-gray-200 p-3 font-semibold">Email</th>
                        <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                        <th class="border border-gray-200 p-3 font-semibold">Angkatan</th>
                        <th class="border border-gray-200 p-3 font-semibold">IPK</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($total_data > 0) : ?>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($query)) : 
                        ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-200 p-3 text-center"><?= $no++ ?></td>
                                <td class="border border-gray-200 p-3 font-medium"><?= htmlspecialchars($row['nim']) ?></td>
                                <td class="border border-gray-200 p-3"><?= htmlspecialchars($row['nama']) ?></td>
                                <td class="border border-gray-200 p-3"><?= htmlspecialchars($row['email']) ?></td>
                                <td class="border border-gray-200 p-3"><?= htmlspecialchars($row['prodi']) ?></td>
                                <td class="border border-gray-200 p-3"><?= htmlspecialchars($row['angkatan']) ?></td>
                                <td class="border border-gray-200 p-3"><?= htmlspecialchars($row['ipk']) ?></td>
                                <td class="border border-gray-200 p-3 text-center">
                                    <a href="edit_modifikasi.php?nim=<?= urlencode($row['nim']) ?>"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 rounded-md mr-1 transition inline-block">
                                        Edit
                                    </a>
                                    <a href="delete_modifikasi.php?nim=<?= urlencode($row['nim']) ?>"
                                       class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded-md transition inline-block"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= addslashes($row['nama']) ?> (NIM: <?= addslashes($row['nim']) ?>)?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <!-- MODIFIKASI 2: Tampilan pesan saat data tidak ditemukan / kosong -->
                        <tr>
                            <td colspan="8" class="border border-gray-200 p-6 text-center text-gray-500 italic">
                                <?= !empty($cari) ? "Data pencarian dengan kata kunci \"<b>" . htmlspecialchars($cari) . "</b>\" tidak ditemukan." : "Belum ada data mahasiswa yang tersimpan." ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
