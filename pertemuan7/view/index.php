<?php
if (!isset($daftar_produk)) {
    header("Location: ../index.php");
    exit;
}

$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Arsitektur MVC</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
            <div>
                <h1 class="text-lg font-bold text-slate-900 leading-tight">Manajemen Produk</h1>
                <p class="text-xs text-slate-500">Arsitektur MVC - Pertemuan 7</p>
            </div>

            <div class="flex items-center space-x-2">
                <a href="koneksi.php" target="_blank" class="text-xs bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg font-medium transition">
                    Cek Koneksi
                </a>
                <a href="index.php?aksi=create" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-xl transition shadow-sm inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <?php if ($pesan === 'tambah_sukses'): ?>
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <p class="font-semibold">Produk Berhasil Ditambahkan</p>
                    <p class="text-xs text-emerald-600">Data baru telah tersimpan ke database.</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 font-bold">&times;</button>
            </div>
        <?php elseif ($pesan === 'edit_sukses'): ?>
            <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <p class="font-semibold">Perubahan Berhasil Disimpan</p>
                    <p class="text-xs text-blue-600">Data produk telah berhasil diperbarui.</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700 font-bold">&times;</button>
            </div>
        <?php elseif ($pesan === 'hapus_sukses'): ?>
            <div class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <p class="font-semibold">Produk Berhasil Dihapus</p>
                    <p class="text-xs text-amber-600">Data telah dihapus dari tabel produk.</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-amber-500 hover:text-amber-700 font-bold">&times;</button>
            </div>
        <?php elseif ($pesan === 'tidak_ditemukan'): ?>
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <p class="font-semibold">Produk Tidak Ditemukan</p>
                    <p class="text-xs text-rose-600">ID produk tidak tersedia di database.</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Jenis Produk</p>
                <p class="text-2xl font-extrabold text-slate-900 mt-1"><?= number_format($statistik['total_produk'] ?? 0) ?></p>
                <p class="text-xs text-slate-400 mt-1">Item terdaftar</p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Total Stok Tersedia</p>
                <p class="text-2xl font-extrabold text-slate-900 mt-1"><?= number_format($statistik['total_stok'] ?? 0) ?></p>
                <p class="text-xs text-slate-400 mt-1">Unit</p>
            </div>

            <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Estimasi Nilai Stok</p>
                <p class="text-2xl font-extrabold text-slate-900 mt-1">Rp <?= number_format($statistik['total_nilai'] ?? 0, 0, ',', '.') ?></p>
                <p class="text-xs text-slate-400 mt-1">Akumulasi aset</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="p-5 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Katalog Produk</h2>
                    <p class="text-xs text-slate-500">Kelola inventaris penjualan barang.</p>
                </div>

                <form action="index.php" method="GET" class="flex items-center gap-2 max-w-md w-full md:w-auto">
                    <input type="hidden" name="aksi" value="index">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="cari" value="<?= htmlspecialchars($cari) ?>"
                               placeholder="Cari nama produk..."
                               class="w-full pl-9 pr-4 py-2 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-xl transition cursor-pointer">
                        Cari
                    </button>
                    <?php if (!empty($cari)): ?>
                        <a href="index.php" class="bg-slate-100 hover:bg-slate-200 text-slate-600 text-sm font-medium px-3 py-2 rounded-xl transition">
                            Reset
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-200">
                            <th class="py-3.5 px-4 text-center w-14">No</th>
                            <th class="py-3.5 px-4">Nama Produk</th>
                            <th class="py-3.5 px-4">Harga Satuan</th>
                            <th class="py-3.5 px-4 text-center">Stok</th>
                            <th class="py-3.5 px-4 text-center w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if (empty($daftar_produk)): ?>
                            <tr>
                                <td colspan="5" class="py-12 px-4 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <p class="text-base font-semibold text-slate-700">Tidak ada data produk ditemukan</p>
                                        <p class="text-xs text-slate-500 mt-1 max-w-sm">
                                            <?= !empty($cari) ? 'Tidak ditemukan produk dengan kata kunci "' . htmlspecialchars($cari) . '".' : 'Belum ada produk yang tersimpan di dalam database.' ?>
                                        </p>
                                        <?php if (!empty($cari)): ?>
                                            <a href="index.php" class="mt-3 text-xs font-medium text-indigo-600 hover:underline">Reset Pencarian</a>
                                        <?php else: ?>
                                            <a href="index.php?aksi=create" class="mt-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2 rounded-xl transition">Tambah Produk Pertama</a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($daftar_produk as $item): ?>
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-3.5 px-4 text-center font-medium text-slate-400"><?= $no++ ?></td>
                                    <td class="py-3.5 px-4">
                                        <div class="font-semibold text-slate-800"><?= htmlspecialchars($item['nama_produk']) ?></div>
                                        <div class="text-xs text-slate-400">ID: #<?= $item['id'] ?></div>
                                    </td>
                                    <td class="py-3.5 px-4 font-semibold text-indigo-600">
                                        Rp <?= number_format($item['harga'], 0, ',', '.') ?>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <?php 
                                        $stok = (int) $item['stok'];
                                        if ($stok == 0) {
                                            $badgeClass = "bg-rose-50 text-rose-700 border-rose-200";
                                            $badgeText = "Habis";
                                        } elseif ($stok <= 10) {
                                            $badgeClass = "bg-amber-50 text-amber-700 border-amber-200";
                                            $badgeText = "$stok Unit";
                                        } else {
                                            $badgeClass = "bg-emerald-50 text-emerald-700 border-emerald-200";
                                            $badgeText = "$stok Unit";
                                        }
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border <?= $badgeClass ?>">
                                            <?= $badgeText ?>
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center">
                                        <div class="inline-flex items-center justify-center space-x-2">
                                            <a href="index.php?aksi=edit&id=<?= $item['id'] ?>"
                                               class="bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                Edit
                                            </a>
                                            <a href="index.php?aksi=delete&id=<?= $item['id'] ?>"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                               class="bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                <div>
                    Menampilkan <span class="font-semibold text-slate-700"><?= count($daftar_produk) ?></span> item produk.
                </div>
                <div class="font-mono text-slate-400">
                    db_penjualan &bull; produk
                </div>
            </div>
        </div>
    </main>

</body>
</html>
