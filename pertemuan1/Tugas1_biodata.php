<?php
// Tugas1_biodata.php - Modifikasi Biodata dari biodata.php
// Modifikasi yang diterapkan:
// 1. Penambahan Field Baru & Array (Email, Status Keaktifan, dan Array Hobi)
// 2. Fungsi & Kondisi Baru (Kategori Predikat Cumlaude & Cek Kelayakan Beasiswa)
// 3. Penanganan Render Data Tipe Array (implode hobi)

function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.75) return 'Dengan Pujian (Cumlaude)'; // Modifikasi 2: Kondisi Cumlaude baru
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    if ($ipk >= 2.50) return 'Cukup';
    return 'Perlu Peningkatan';
}

// Modifikasi 2: Fungsi Baru Cek Kelayakan Beasiswa
function cekKelayakanBeasiswa(float $ipk, int $semester): string
{
    if ($ipk >= 3.50 && $semester >= 2) {
        return 'Layak Menerima Beasiswa';
    }
    return 'Belum Memenuhi Syarat Beasiswa';
}

// Modifikasi 1: Field Baru (Email, Status, Hobi)
$mahasiswa = [
    'nim' => '4524210091',
    'nama' => 'Riziq Wijaya',
    'prodi' => 'Teknik Informatika',
    'semester' => 3,
    'ipk' => 3.85,
    'email' => 'riziq@example.com',
    'status' => 'Aktif',
    'hobi' => ['Pemrograman', 'Membaca Buku', 'Bulu Tangkis']
];
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tugas 1 - Biodata Mahasiswa</title>
</head>

<body>
    <h1>Biodata Mahasiswa (Tugas 1)</h1>
    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <li>
                <strong><?= ucfirst($kunci) ?>:</strong> 
                <?php if (is_array($nilai)): ?>
                    <!-- Modifikasi 3: Penanganan elemen bertipe array -->
                    <?= htmlspecialchars(implode(', ', $nilai)) ?>
                <?php else: ?>
                    <?= htmlspecialchars((string)$nilai) ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Modifikasi 2: Menampilkan hasil fungsi baru -->
    <p><strong>Predikat Kelulusan:</strong> <?= statusKelulusan($mahasiswa['ipk']) ?></p>
    <p><strong>Status Beasiswa:</strong> <?= cekKelayakanBeasiswa($mahasiswa['ipk'], $mahasiswa['semester']) ?></p>
</body>

</html>
