Sebelum dimodifikasi (form.php): <br>
<img width="587" height="657" alt="image" src="https://github.com/user-attachments/assets/836f4e9e-6da8-43d1-a9f9-595b01851458" />

<br>

Hasil Running: <br>
<img width="1906" height="991" alt="image" src="https://github.com/user-attachments/assets/7f5ca528-b0a6-4354-9104-421644bc2b5b" />

<br>

Sesudah dimodifikasi (Tugas1.php): <br>
<img width="1200" height="675" alt="image" src="https://github.com/user-attachments/assets/5406058b-1820-4cab-b902-27600d3d190e" />

<br>

Hasil running: <br>
<img width="1914" height="944" alt="image" src="https://github.com/user-attachments/assets/6eae90c2-9957-456c-a396-733e32af0d5f" />


<br>
<br>

Modifikasi 1: Peningkatan Komponen Input & Validasi Atribut Form <br>
Modifikasi 2: Peningkatan Antarmuka (UI/UX), Tombol Aksi Tambahan & Navigasi <br>

1. mysqli_connect() (koneksi.php): Menginisialisasi koneksi antara skrip PHP dengan database server MySQL.

2. CREATE TABLE IF NOT EXISTS (setup.php): Mendefinisikan skema tabel mahasiswa beserta penetapan tipe data dan PRIMARY KEY.

3. <form action="simpan.php" method="post"> (form.php/ Tugas1.php): Mengirimkan kumpulan data input dari antarmuka ke backend secara aman melalui metode HTTP POST.

4. Superglobal $_POST & INSERT INTO (simpan.php): Menangkap nilai formulir dan menyisipkan record data baru ke dalam tabel basis data.

5. Perulangan while & mysqli_fetch_assoc() (data.php): Membaca dan menguraikan baris hasil query SELECT menjadi array asosiatif untuk ditampilkan.

<br>
<br>
Pesan Error: <br>
Fatal error: Uncaught mysqli_sql_exception: Duplicate entry '...' for key 'PRIMARY' pada simpan.php <br>
Penyebab: <br>
Mencoba menginput data mahasiswa dengan NIM yang sudah terdaftar sebelumnya di database (karena kolom nim berstatus PRIMARY KEY).
Cara Mengatasi: <br>
Gunakan NIM yang unik/berbeda saat input, atau tambahkan validasi pengecekan NIM sebelum query INSERT:

<br>
<br>

Sebelum dimodifikasi (simpan.php): <br>
<img width="633" height="600" alt="image" src="https://github.com/user-attachments/assets/add05b7a-8ad6-4919-88bf-f0bd3bea551d" />

<br>

Hasil running: <br>
<img width="1919" height="995" alt="image" src="https://github.com/user-attachments/assets/7dcab3fb-c83f-4028-84db-08cefd37eb4b" />

<br>

Sesudah dimodifikasi (Tugas2.php): <br>
<img width="879" height="980" alt="image" src="https://github.com/user-attachments/assets/2c9077d3-133b-41e4-8fbc-e5dce7eee63e" />

<br> 

Hasil running: <br>
<img width="1906" height="986" alt="image" src="https://github.com/user-attachments/assets/e4dc81db-70a8-448c-ac94-54fb267bec87" />

<br>
<br>

Modifikasi 1 (Validasi Metode POST & Pengecekan Duplikasi NIM) <br>
Modifikasi 2 (Feedback Rincian Data & Tautan Navigasi)

<br>

1. $_SERVER['REQUEST_METHOD'] !== 'POST': Memvalidasi bahwa skrip hanya diproses saat menerima kiriman formulir via HTTP POST (mencegah akses langsung via URL browser).
2. Penyaringan Input (trim(), (int), (float)): Membersihkan spasi tak terlihat dan mengonversi tipe data angka secara eksplisit (type casting) agar masukan valid dan aman.
3. Pengecekan Duplikasi NIM (mysqli_num_rows($cek) > 0): Mendeteksi apakah NIM sudah terdaftar di tabel sebelum INSERT dijalankan untuk mencegah kegagalan Primary Key.
4. Query DML INSERT INTO mahasiswa: Menyimpan seluruh atribut mahasiswa (NIM, nama, email, prodi, angkatan, IPK) ke dalam database MySQL.
5. Percabangan Hasil (if ($query) ... else): Memvalidasi status eksekusi query untuk menampilkan umpan balik rincian data jika berhasil, atau menampilkan mysqli_error() jika gagal.

<br>

Error: Duplicate entry for key 'PRIMARY' <br>
Cara Mengatasi: Menambahkan query pengecekan data awal menggunakan SELECT ... WHERE nim = '$nim' dan mysqli_num_rows() sebelum perintah INSERT dieksekusi. <br>

Error: Unknown database 'akademik1' <br>
Cara Mengatasi: Menjalankan query pembuatan database di MySQL/phpMyAdmin:
