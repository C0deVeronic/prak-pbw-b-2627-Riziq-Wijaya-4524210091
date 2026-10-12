<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Tambah Mahasiswa (Modifikasi)</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <form action="store_modifikasi.php" method="POST"
        class="max-w-sm mx-auto bg-white p-6 rounded-lg shadow-md flex flex-col">

        <h2 class="text-2xl font-bold mb-4 text-gray-800">
            Tambah Mahasiswa
        </h2>

        <label for="nim" class="text-sm font-semibold mb-1">NIM:</label>
        <input type="text" id="nim" name="nim" placeholder="Contoh: 4524210091" required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">

        <label for="nama" class="text-sm font-semibold mb-1">Nama:</label>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">

        <label for="email" class="text-sm font-semibold mb-1">Email:</label>
        <input type="email" id="email" name="email" placeholder="nama@email.com" required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">

        <!-- MODIFIKASI 1: Mengubah input Prodi menjadi dropdown <select> agar data konsisten -->
        <label for="prodi" class="text-sm font-semibold mb-1">Prodi:</label>
        <select id="prodi" name="prodi" required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500 bg-white">
            <option value="" disabled selected>-- Pilih Program Studi --</option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Elektro">Teknik Elektro</option>
            <option value="Teknik Industri">Teknik Industri</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
        </select>

        <label for="angkatan" class="text-sm font-semibold mb-1">Angkatan:</label>
        <input type="number" id="angkatan" name="angkatan" placeholder="Contoh: 2024" min="2000" max="2099" required
            class="mb-4 p-2 border border-gray-300 rounded focus:outline-blue-500">

        <!-- MODIFIKASI 2: Validasi rentang nilai IPK (0.00 - 4.00) dan penambahan tombol "Batal" kembali ke index_modifikasi.php -->
        <label for="ipk" class="text-sm font-semibold mb-1">IPK (0.00 - 4.00):</label>
        <input type="number" id="ipk" name="ipk" step="0.01" min="0" max="4.00" placeholder="Contoh: 3.75" required
            class="mb-6 p-2 border border-gray-300 rounded focus:outline-blue-500">

        <!-- Tombol Aksi: Simpan dan Batal -->
        <div class="flex gap-2">
            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition cursor-pointer">
                Simpan
            </button>
            <a href="index_modifikasi.php" class="flex-1 text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 rounded transition">
                Batal
            </a>
        </div>
    </form>

</body>
</html>
