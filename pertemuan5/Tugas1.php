<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas 1 - Form Tambah Mahasiswa (Modifikasi)</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #eef2f7 0%, #dbe4ee 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #334155;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 520px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .card-header {
            background: #2563eb;
            color: #ffffff;
            padding: 22px 28px;
            text-align: center;
        }

        .card-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .card-header p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .card-body {
            padding: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .form-group .required-star {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            font-size: 0.925rem;
            color: #1e293b;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease-in-out;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn {
            flex: 1;
            padding: 11px 16px;
            font-size: 0.95rem;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.25);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
            color: #1e293b;
        }

        .card-footer {
            padding: 14px 28px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 0.85rem;
        }

        .card-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .btn-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <!-- MODIFIKASI 2: Desain Card UI Modern, Rapi, dan Responsif -->
    <div class="card">
        <div class="card-header">
            <h2>Form Pendaftaran Mahasiswa</h2>
            <p>Tugas 1 - Modifikasi Form Pertemuan 5</p>
        </div>

        <div class="card-body">
            <form action="Tugas2.php" method="POST">
                
                <!-- Input NIM: dengan pattern angka dan maxlength -->
                <div class="form-group">
                    <label for="nim">NIM <span class="required-star">*</span></label>
                    <input type="text" 
                           id="nim" 
                           name="nim" 
                           class="form-control" 
                           placeholder="Contoh: 4524210091" 
                           pattern="[0-9]+" 
                           maxlength="20" 
                           title="NIM hanya boleh berisi angka"
                           required>
                </div>

                <!-- Input Nama Lengkap -->
                <div class="form-group">
                    <label for="nama">Nama Lengkap <span class="required-star">*</span></label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           class="form-control" 
                           placeholder="Masukkan nama lengkap" 
                           required>
                </div>

                <!-- Input Email -->
                <div class="form-group">
                    <label for="email">Email Kampus <span class="required-star">*</span></label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-control" 
                           placeholder="nama@kampus.ac.id" 
                           required>
                </div>

                <!-- MODIFIKASI 1: Prodi Menggunakan Pilihan <select> Dropdown -->
                <div class="form-group">
                    <label for="prodi">Program Studi <span class="required-star">*</span></label>
                    <select id="prodi" name="prodi" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                    </select>
                </div>

                <div class="form-row">
                    <!-- Input Angkatan: dengan batas rentang tahun -->
                    <div class="form-group">
                        <label for="angkatan">Angkatan <span class="required-star">*</span></label>
                        <input type="number" 
                               id="angkatan" 
                               name="angkatan" 
                               class="form-control" 
                               placeholder="Contoh: 2024" 
                               min="2015" 
                               max="2026" 
                               required>
                    </div>

                    <!-- MODIFIKASI 1: IPK dengan batasan min 0.00 dan max 4.00 -->
                    <div class="form-group">
                        <label for="ipk">IPK <span class="required-star">*</span></label>
                        <input type="number" 
                               id="ipk" 
                               name="ipk" 
                               class="form-control" 
                               step="0.01" 
                               min="0.00" 
                               max="4.00" 
                               placeholder="0.00 - 4.00" 
                               required>
                    </div>
                </div>

                <!-- MODIFIKASI 2: Tombol Aksi Simpan dan Reset -->
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                    <button type="reset" class="btn btn-secondary">Reset Form</button>
                </div>

            </form>
        </div>

        <div class="card-footer">
            <a href="data.php">&larr; Lihat Rekapitulasi Data Mahasiswa</a>
        </div>
    </div>

</body>
</html>
