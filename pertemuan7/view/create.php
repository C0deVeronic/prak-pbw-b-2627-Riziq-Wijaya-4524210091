<?php
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru - Arsitektur MVC</title>
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 py-3.5 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="index.php" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition">
                    &larr;
                </a>
                <div>
                    <h1 class="text-base font-bold text-slate-900 leading-tight">Tambah Produk Baru</h1>
                    <p class="text-xs text-slate-500">Formulir Tambah Data Produk</p>
                </div>
            </div>
            <a href="index.php" class="text-xs text-slate-500 hover:text-indigo-600 font-medium transition">
                Kembali ke Daftar
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-4 sm:px-6 py-8">

        <?php if ($error === 'input_tidak_valid'): ?>
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <span class="font-semibold">Input Tidak Valid:</span> Semua kolom wajib diisi dan nilai tidak boleh negatif.
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
            </div>
        <?php elseif ($error === 'gagal_simpan'): ?>
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between text-sm shadow-xs">
                <div>
                    <span class="font-semibold">Gagal Menyimpan:</span> Terjadi kesalahan sistem saat menyimpan ke database.
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
            <div class="mb-6 border-b border-slate-100 pb-4">
                <h2 class="text-lg font-bold text-slate-800">Formulir Produk</h2>
                <p class="text-xs text-slate-500 mt-1">Masukkan rincian nama produk, harga satuan, dan jumlah stok.</p>
            </div>

            <form action="index.php?aksi=store" method="POST" class="space-y-5">
                <div>
                    <label for="nama_produk" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Produk <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="nama_produk" name="nama_produk" required
                           placeholder="Contoh: Laptop Asus VivoBook"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                <div>
                    <label for="harga" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Harga Satuan (Rupiah) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 font-semibold text-sm">
                            Rp
                        </span>
                        <input type="number" id="harga" name="harga" min="0" step="500" required
                               placeholder="1500000"
                               class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    </div>
                </div>

                <div>
                    <label for="stok" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Jumlah Stok <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" id="stok" name="stok" min="0" required
                           placeholder="25"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="index.php" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-sm font-semibold transition">
                        Batal
                    </a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-6 py-2.5 rounded-xl shadow-sm transition cursor-pointer">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
