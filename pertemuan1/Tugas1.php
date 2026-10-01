<?php
// Tugas1.php - Modifikasi Kalkulator dari kalkulator.php
// Modifikasi yang diterapkan:
// 1. Operator Baru: Modulo (%) dan Pangkat (^)
// 2. Field Baru: Pilihan Presisi Desimal
// 3. Validasi Baru: Operasi modulo dengan angka nol

$hasil = null;
$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';
    $presisi = (int) ($_POST['presisi'] ?? 2);

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '%': // Modifikasi 1: Operator Modulo (Sisa Bagi)
            if ($b == 0) { // Modifikasi 2: Validasi Modulo dengan nol
                $pesan = 'Modulo dengan nol tidak diperbolehkan.';
            } else {
                $hasil = fmod($a, $b);
            }
            break;
        case '^': // Modifikasi 1: Operator Pangkat
            $hasil = pow($a, $b);
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }

    if ($hasil !== null && $pesan === "") {
        $hasil = number_format($hasil, $presisi, ',', '.');
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tugas 1 - Kalkulator</title>
</head>

<body>
    <h1>Kalkulator Tugas 1</h1>
    <form method="post">
        <input type="number" step="any" name="a" required value="<?= htmlspecialchars($_POST['a'] ?? '') ?>">
        <select name="operator">
            <option value="+" <?= ($_POST['operator'] ?? '') === '+' ? 'selected' : '' ?>>+</option>
            <option value="-" <?= ($_POST['operator'] ?? '') === '-' ? 'selected' : '' ?>>-</option>
            <option value="*" <?= ($_POST['operator'] ?? '') === '*' ? 'selected' : '' ?>>*</option>
            <option value="/" <?= ($_POST['operator'] ?? '') === '/' ? 'selected' : '' ?>>/</option>
            <option value="%" <?= ($_POST['operator'] ?? '') === '%' ? 'selected' : '' ?>>% (Modulo)</option>
            <option value="^" <?= ($_POST['operator'] ?? '') === '^' ? 'selected' : '' ?>>^ (Pangkat)</option>
        </select>
        <input type="number" step="any" name="b" required value="<?= htmlspecialchars($_POST['b'] ?? '') ?>">
        
        <!-- Modifikasi 3: Field Baru Presisi Desimal -->
        <label for="presisi">Presisi Desimal:</label>
        <select name="presisi" id="presisi">
            <option value="0" <?= ($_POST['presisi'] ?? '') === '0' ? 'selected' : '' ?>>0</option>
            <option value="2" <?= ($_POST['presisi'] ?? '2') === '2' ? 'selected' : '' ?>>2</option>
            <option value="4" <?= ($_POST['presisi'] ?? '') === '4' ? 'selected' : '' ?>>4</option>
        </select>

        <button type="submit">Hitung</button>
    </form>

    <?php if ($pesan): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php elseif ($hasil !== null): ?>
        <p>Hasil: <?= htmlspecialchars((string)$hasil) ?></p>
    <?php endif; ?>
</body>

</html>
