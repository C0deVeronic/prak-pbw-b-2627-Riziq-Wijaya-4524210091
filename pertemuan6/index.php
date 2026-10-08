<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">

    <div class="max-w-5xl mx-auto bg-white shadow-md p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Mahasiswa</h2>

        <a href="create.php"
           class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded-md mb-4">
            + Tambah Mahasiswa
        </a>

<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-200 text-left">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-200 p-3 font-semibold">NIM</th>
                <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                <th class="border border-gray-200 p-3 font-semibold">Email</th>
                <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                <th class="border border-gray-200 p-3 font-semibold">
                    Angkatan
                </th>
                <th class="border border-gray-200 p-3 font-semibold">IPK</th>
                <th class="border border-gray-200 p-3 font-semibold text-center">
                    Aksi
                </th>
            </tr>
        </thead>


        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td class="border border-gray-200 p-3"><?= $row['nim'] ?></td>
                    <td class="border border-gray-200 p-3"><?= $row['nama'] ?></td>
                    <td class="border border-gray-200 p-3"><?= $row['email'] ?></td>
                    <td class="border border-gray-200 p-3"><?= $row['prodi'] ?></td>
                    <td class="border border-gray-200 p-3"><?= $row['angkatan'] ?></td>
                    <td class="border border-gray-200 p-3"><?= $row['ipk'] ?></td>
                    <td class="border border-gray-200 p-3 text-center">
                        <a href="edit.php?nim=<?= $row['nim'] ?>"
                           class="bg-yellow-500 text-white px-2 py-1 rounded-md mr-2">
                            Edit
                        </a>
                        <a href="delete.php?nim=<?= $row['nim'] ?>"
                           class="bg-red-600 text-white px-2 py-1 rounded-md"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>