Sebelum dimodifikasi (Contoh1.php): <br>
<img width="902" height="1189" alt="image" src="https://github.com/user-attachments/assets/cd8634d1-bb7a-43e8-b5dd-e1d76355fdf5" />
Hasil Running: <br>
<img width="436" height="320" alt="image" src="https://github.com/user-attachments/assets/cad30698-76d8-4786-bf2b-8698e997dcbd" />

<br>
<br>

Setelah dimodifikasi (Tugas4_1.php): <br>
<img width="964" height="1626" alt="image" src="https://github.com/user-attachments/assets/41ab6a20-b924-486b-af02-f33818006f02" />

Hasil Running: <br>
<img width="515" height="316" alt="image" src="https://github.com/user-attachments/assets/78fc1024-769d-446e-a6fa-a9e10353a4ee" />

<br>
<br>

Modifikasi 1 (Validasi Predikat Kelulusan Bertingkat): Meningkatkan logika pengkondisan rentang IPK (>= 3.80 Cumlaude, >= 3.50 Sangat Memuaskan, >= 3.00 Memuaskan, dan < 3.00 Cukup). <br>
Modifikasi 2 (Query Statistik Yang Lebih Rinci): Menambahkan MAX(ipk) dan MIN(ipk) pada statistik agregat SQL untuk menampilkan nilai IPK tertinggi dan terendah selain jumlah total dan rata-rata.

<br>
<br>

Sebelum dimodifikasi (Contoh2.php): <br>
<img width="918" height="1721" alt="image" src="https://github.com/user-attachments/assets/217b043d-c126-40dc-bb9c-a0f521d204ef" />
Hasil Running: <br>
<img width="608" height="321" alt="image" src="https://github.com/user-attachments/assets/f5a2ffe1-2797-4e2f-9cea-cb84f695df10" />

<br>
<br>

Setelah dimodifikasi (Tugas4_2.php): <br>
<img width="1064" height="1968" alt="image" src="https://github.com/user-attachments/assets/d33f3728-d60d-4d40-839b-88f2feddb424" />
Hasil Running: <br>
<img width="690" height="332" alt="image" src="https://github.com/user-attachments/assets/24fe4c88-4aa7-4cce-ab01-c5d98613f27e" />

<br>
<br>

Modifikasi 1 (Update Multi-Kolom): Pengubahan data UPDATE diperluas untuk memperbarui beberapa atribut sekaligus (ipk dan prodi). <br>
Modifikasi 2 (Rekapitulasi Lanjutan & Audit Sisa Data): Menambahkan statistik IPK Tertinggi (MAX(ipk)) dan IPK Terendah (MIN(ipk)) pada query GROUP BY prodi dengan tambahan HAVING.

<br>
<br>

### 5 Bagian Kode Paling Penting (Pertemuan 4):
1. **`INSERT IGNORE INTO`**: Menyisipkan record data baru ke tabel tanpa menimbulkan crash jika terjadi bentrokan nilai pada kunci unik (`NIM`). <br>
2. **`SELECT ... WHERE ... ORDER BY`**: Menyaring data mahasiswa berdasarkan syarat tertentu (`IPK >= 3.50`) dan mengurutkan hasilnya. <br>
3. **Fungsi Agregasi SQL (`COUNT()`, `AVG()`, `MAX()`, `MIN()`)**: Menghitung ringkasan statistik (jumlah mahasiswa, rata-rata IPK, serta nilai tertinggi & terendah). <br>
4. **Klausul `GROUP BY` & `HAVING`**: Mengelompokkan baris data berdasarkan nama Program Studi untuk menyajikan rekapitulasi data per prodi. <br>
5. **Pemeriksaan `mysqli_num_rows()` & `mysqli_fetch_assoc()`**: Memeriksa keberadaan baris data hasil query sebelum menguraikannya ke dalam array asosiatif pada perulangan `while`. <br>

<br>
<br>

Error yang muncul di Contoh1: <br>
PHP Fatal error: Uncaught mysqli_sql_exception: Duplicate entry '2026001' for key 'mahasiswa.nim' in C:\xampp\htdocs\pertemuan1\pertemuan4\contoh1.php on line 11 <br>
Cara memperbaikinya: Ganti query INSERT INTO pada contoh1.php menjadi INSERT IGNORE <br>

<br>

Error yang muncul di Contoh2: <br>
Jika tabel mahasiswa dijadikan acuan (parent) oleh tabel lain (seperti tabel krs atau nilai_kuliah), MySQL menolak penghapusan baris mahasiswa tersebut demi menjaga integritas data.<br>
Perbaikan: Tambahkan relasi ON DELETE CASCADE pada definisi Foreign Key tabel anak agar data di tabel anak terhapus otomatis saat data mahasiswa dihapus.
