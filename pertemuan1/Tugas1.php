<?php
// Tugas1.php - Modifikasi Kalkulator Sederhana
// Modifikasi yang diterapkan:
// 1. Operator Baru: Tambahan Modulo (%), Perpangkatan (^), dan Akar Kuadrat (√).
// 2. Validasi & Kondisi Baru: Validasi pembagian/modulo dengan nol, validasi akar dari angka negatif, dan kontrol input dinamis.
// 3. Field Baru (Presisi Desimal): Pilihan jumlah angka desimal untuk pembulatan hasil.
// 4. Modern UI & Styling: Desain responsif bergaya Glassmorphism dengan CSS modern, badge status, serta animasi visual.

$hasil = null;
$hasilFormatted = null;
$pesan = "";
$ekspresi = "";

$a = $_POST['a'] ?? '';
$b = $_POST['b'] ?? '';
$operator = $_POST['operator'] ?? '+';
$presisi = isset($_POST['presisi']) ? (int)$_POST['presisi'] : 2;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numA = is_numeric($a) ? (float)$a : 0;
    $numB = is_numeric($b) ? (float)$b : 0;

    switch ($operator) {
        case '+':
            $hasil = $numA + $numB;
            $ekspresi = "$numA + $numB";
            break;
        case '-':
            $hasil = $numA - $numB;
            $ekspresi = "$numA - $numB";
            break;
        case '*':
            $hasil = $numA * $numB;
            $ekspresi = "$numA × $numB";
            break;
        case '/':
            if ($numB == 0) {
                $pesan = 'Pembagian dengan angka 0 tidak diperbolehkan.';
            } else {
                $hasil = $numA / $numB;
                $ekspresi = "$numA ÷ $numB";
            }
            break;
        case '%': // Modifikasi: Modulo
            if ($numB == 0) {
                $pesan = 'Operasi Modulo (%) dengan angka 0 tidak diperbolehkan.';
            } else {
                $hasil = fmod($numA, $numB);
                $ekspresi = "$numA mod $numB";
            }
            break;
        case '^': // Modifikasi: Pangkat
            $hasil = pow($numA, $numB);
            $ekspresi = "$numA <sup>$numB</sup>";
            break;
        case 'sqrt': // Modifikasi: Akar Kuadrat
            if ($numA < 0) { // Modifikasi Validasi
                $pesan = 'Akar kuadrat dari bilangan negatif tidak terdefinisi pada bilangan riil.';
            } else {
                $hasil = sqrt($numA);
                $ekspresi = "√$numA";
            }
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }

    if ($hasil !== null && $pesan === "") {
        // Format hasil dengan presisi desimal terpilih
        $hasilFormatted = number_format($hasil, $presisi, ',', '.');
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 1 - Kalkulator Lanjutan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311042 100%);
            --card-bg: rgba(255, 255, 255, 0.07);
            --card-border: rgba(255, 255, 255, 0.12);
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --danger-bg: rgba(239, 68, 68, 0.15);
            --danger-text: #fca5a5;
            --danger-border: rgba(239, 68, 68, 0.3);
            --success-bg: rgba(16, 185, 129, 0.15);
            --success-text: #6ee7b7;
            --success-border: rgba(16, 185, 129, 0.3);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-primary);
        }

        .container {
            width: 100%;
            max-width: 480px;
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(to right, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        .header p {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 90px 1fr;
            gap: 10px;
            align-items: center;
        }

        .single-input {
            grid-template-columns: 1fr 120px;
        }

        input[type="number"], select {
            width: 100%;
            padding: 14px 16px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 1rem;
            font-weight: 500;
            outline: none;
            transition: all 0.2s ease;
        }

        input[type="number"]:focus, select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }

        select {
            cursor: pointer;
            text-align: center;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            padding-right: 30px;
            appearance: none;
        }

        select option {
            background: #1e1b4b;
            color: #fff;
        }

        .settings-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.03);
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            margin-bottom: 24px;
        }

        .settings-row label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0;
            text-transform: none;
            letter-spacing: normal;
        }

        .settings-row select {
            width: auto;
            padding: 8px 30px 8px 12px;
            font-size: 0.875rem;
        }

        .btn-group {
            display: flex;
            gap: 12px;
        }

        button {
            flex: 1;
            padding: 14px;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        button:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        .btn-reset {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-secondary);
            box-shadow: none;
            flex: 0 0 100px;
        }

        .btn-reset:hover {
            background: rgba(255, 255, 255, 0.2);
            color: var(--text-primary);
        }

        .result-card {
            margin-top: 28px;
            padding: 20px;
            border-radius: 16px;
            animation: fadeIn 0.3s ease;
        }

        .result-success {
            background: var(--success-bg);
            border: 1px solid var(--success-border);
            color: var(--success-text);
        }

        .result-error {
            background: var(--danger-bg);
            border: 1px solid var(--danger-border);
            color: var(--danger-text);
        }

        .result-expression {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-bottom: 4px;
        }

        .result-value {
            font-size: 1.75rem;
            font-weight: 700;
            word-break: break-all;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .badge-container {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .badge {
            font-size: 0.725rem;
            background: rgba(255, 255, 255, 0.08);
            padding: 4px 10px;
            border-radius: 20px;
            color: var(--text-secondary);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Kalkulator Lanjutan</h1>
            <p>Tugas 1 - Modifikasi Program PHP Kalkulator</p>
        </div>

        <form method="post" action="">
            <div class="form-group">
                <label>Input Perhitungan</label>
                <div class="input-row" id="inputRow">
                    <input type="number" step="any" name="a" placeholder="Angka 1" value="<?= htmlspecialchars((string)$a) ?>" required>
                    
                    <select name="operator" id="operatorSelect" onchange="toggleSecondInput()">
                        <option value="+" <?= $operator === '+' ? 'selected' : '' ?>>+ (Tambah)</option>
                        <option value="-" <?= $operator === '-' ? 'selected' : '' ?>>- (Kurang)</option>
                        <option value="*" <?= $operator === '*' ? 'selected' : '' ?>>* (Kali)</option>
                        <option value="/" <?= $operator === '/' ? 'selected' : '' ?>>/ (Bagi)</option>
                        <option value="%" <?= $operator === '%' ? 'selected' : '' ?>>% (Modulo)</option>
                        <option value="^" <?= $operator === '^' ? 'selected' : '' ?>>^ (Pangkat)</option>
                        <option value="sqrt" <?= $operator === 'sqrt' ? 'selected' : '' ?>>√ (Akar)</option>
                    </select>

                    <input type="number" step="any" name="b" id="inputB" placeholder="Angka 2" value="<?= htmlspecialchars((string)$b) ?>">
                </div>
            </div>

            <div class="settings-row">
                <label for="presisiSelect">Presisi Desimal Hasil:</label>
                <select name="presisi" id="presisiSelect">
                    <option value="0" <?= $presisi === 0 ? 'selected' : '' ?>>0 Desimal (Bulat)</option>
                    <option value="2" <?= $presisi === 2 ? 'selected' : '' ?>>2 Desimal</option>
                    <option value="4" <?= $presisi === 4 ? 'selected' : '' ?>>4 Desimal</option>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit">Hitung Hasil</button>
                <a href="Tugas1.php" style="text-decoration: none;">
                    <button type="button" class="btn-reset">Reset</button>
                </a>
            </div>
        </form>

        <?php if ($pesan !== ""): ?>
            <div class="result-card result-error">
                <div class="result-expression">Peringatan / Error:</div>
                <div class="result-value" style="font-size: 1rem; font-weight: 500;">
                    <?= htmlspecialchars($pesan) ?>
                </div>
            </div>
        <?php elseif ($hasil !== null): ?>
            <div class="result-card result-success">
                <div class="result-expression">Hasil Perhitungan (<?= htmlspecialchars($ekspresi) ?>):</div>
                <div class="result-value">
                    <?= htmlspecialchars($hasilFormatted) ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="badge-container">
            <span class="badge">✨ Modulo & Pangkat</span>
            <span class="badge">✨ Akar Kuadrat</span>
            <span class="badge">✨ Validasi Nol & Negatif</span>
            <span class="badge">✨ Presisi Desimal</span>
        </div>
    </div>

    <script>
        function toggleSecondInput() {
            const operator = document.getElementById('operatorSelect').value;
            const inputB = document.getElementById('inputB');
            const inputRow = document.getElementById('inputRow');

            if (operator === 'sqrt') {
                inputB.style.display = 'none';
                inputB.required = false;
                inputRow.style.gridTemplateColumns = '1fr 140px';
            } else {
                inputB.style.display = 'block';
                inputB.required = true;
                inputRow.style.gridTemplateColumns = '1fr 90px 1fr';
            }
        }
        // Jalankan saat pertama kali halaman dimuat
        toggleSecondInput();
    </script>
</body>

</html>
