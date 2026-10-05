Sebelum dimodifikasi (contoh1.php):<br>
<img width="671" height="1227" alt="image" src="https://github.com/user-attachments/assets/7b589940-f3dc-47fa-82ba-26a600582b51" />
<br>
Hasil running (contoh1.php):<br>
<img width="535" height="225" alt="image" src="https://github.com/user-attachments/assets/841bf7b6-f7fe-4fd1-9181-2851136367b3" />

<br>
<br>

Setelah Dimodifikasi (Tugas3.php):<br>
<img width="879" height="1721" alt="image" src="https://github.com/user-attachments/assets/4637df2a-8dcb-4a93-b7b0-1ba70c48f965" />
<br>
Hasil Running (Tugas3.php):<br>
<img width="513" height="241" alt="image" src="https://github.com/user-attachments/assets/c6b0ea6b-4453-4908-99d2-bc30bc3a42b9" />

<br>
<br>

Modifikasi 1 (Penambahan Field Baru): Menambahkan kolom status_aktif ENUM('Aktif', 'Cuti', 'Lulus') DEFAULT 'Aktif' dan created_at DATETIME DEFAULT CURRENT_TIMESTAMP pada DDL tabel mahasiswa. <br>
Modifikasi 2 (Query Verifikasi & Rekapitulasi Database): Menambahkan query SHOW TABLES FROM akademik, menghitung total tabel dengan mysqli_num_rows(), serta menampilkan daftar seluruh tabel secara otomatis. <br>

<br>
<br>

### 5 Bagian Kode Paling Penting (Pertemuan 3):
1. **`mysqli_connect($host, $user, $password)`**: Menginisialisasi koneksi antara PHP dan server database MySQL di host lokal (`127.0.0.1`). <br>
2. **`CREATE DATABASE IF NOT EXISTS akademik`**: Menjalankan query pembuatan basis data secara otomatis tanpa menimbulkan error jika database sudah ada. <br>
3. **`mysqli_select_db($koneksi, 'akademik')` & `mysqli_set_charset()`**: Menentukan database target (`akademik`) serta mengatur encoding karakter `utf8mb4`. <br>
4. **`CREATE TABLE IF NOT EXISTS` & Constraint Foreign Key**: Mendefinisikan DDL skema relasional tabel (`mahasiswa`, `dosen`, `mata_kuliah`) beserta aturan relasi `FOREIGN KEY`. <br>
5. **Perulangan `foreach` & `SHOW TABLES FROM akademik`**: Mengeksekusi array DDL pembentukan tabel secara berurutan dan memverifikasi struktur tabel yang berhasil terbuat. <br>

<br>
<br>

Error yang pernah muncul: <br>
mysqli_sql_exception: Unknown database 'akademik' <br>
// atau <br>
mysqli_sql_exception: No database selected <br>
Langkah Perbaikan: Pastikan alur di script selalu: <br>
CREATE DATABASE IF NOT EXISTS akademik; <br>
mysqli_select_db($koneksi, 'akademik'); (Pilih DB) <br>
Baru jalankan perintah CREATE TABLE.
