Tugas 1 <br>
Sebelum dimodifikasi (kalkulator.php):<br>
<img width="679" height="1360" alt="image" src="https://github.com/user-attachments/assets/085b33c5-9dec-4903-a301-9ed5b7ec7fac" />
<img width="1915" height="1000" alt="image" src="https://github.com/user-attachments/assets/c8f04476-c8cf-40b3-9606-f9cf4711a73e" />
<br>
Setelah dimodifikasi (Tugas1.php):<br>
<img width="1908" height="945" alt="image" src="https://github.com/user-attachments/assets/5e7c68d0-fa5e-44a3-93f3-2c37a22353fd" />
<img width="995" height="1949" alt="image" src="https://github.com/user-attachments/assets/62474ace-9c28-44f2-baa4-58360393b708" />
<br>
Penjelasan 5 Bagian Kode Paling Penting:<br>
1. Pemeriksaan Method Request & Inisialisasi Variabel Input
Bagian ini memastikan bahwa logika perhitungan hanya dieksekusi saat form dikirim melalui metode POST. Penggunaan (float) dan (int) berfungsi sebagai penyaring/konversi tipe data aman (casting) untuk mencegah masukan teks/non-angka.

2. Struktur Percabangan Operator (switch ($operator))
Blok ini menentukan ekspresi matematika yang akan dijalankan berdasarkan operator yang dipilih pengguna. Penambahan case '%' (menggunakan fmod) dan case '^' (menggunakan pow) merupakan fitur modifikasi baru dari kalkulator dasar.

3. Validasi Pembagian & Modulo dengan Nol
Fitur penanganan edge case untuk mencegah DivisionByZeroError atau warning pada PHP saat pengguna memasukkan angka 0 sebagai pembagi/modulus. Pesan kesalahan disimpan pada variabel $pesan.

4. Format Desimal Hasil (number_format)
Bagian ini memformat angka keluaran $hasil agar memiliki jumlah angka desimal sesuai pilihan pengguna pada variabel $presisi, serta menggunakan standar format desimal koma (,) dan ribuan titik (.).

5. Kondisional Penampilan Output HTML
Logika view (tampilan) yang secara dinamis memilih apakah akan menampilkan pesan error jika terdapat kesalahan masukan, atau menampilkan teks hasil akhir jika perhitungan berhasil. Penggunaan htmlspecialchars() mencegah celah keamanan XSS.

Error yang Pernah Muncul, Penyebab, & Perbaikannya <br>
! [rejected]        main -> main (fetch first)
error: failed to push some refs to 'https://github.com/C0deVeronic/prak-pbw-b-2627-Riziq-Wijaya-4524210091'
hint: Updates were rejected because the remote contains work that you do not have locally.
<br>
Penyebab: Error ini terjadi saat menjalankan perintah git push karena repository di GitHub sudah berisi commit terdahulu, sedangkan repository lokal baru diinisialisasi secara terpisah sehingga Git menolak push karena riwayat commit lokal tidak memiliki commit terbaru dari remote.

Langkah Perbaikan: Menyelaraskan riwayat commit lokal dengan remote menggunakan rebase dengan perintah:<br>
git pull origin main --rebase
<br>

Sebelum Dimodifikasi (biodata.php):

<img width="1909" height="986" alt="image" src="https://github.com/user-attachments/assets/81fe852b-e025-451d-b1f5-8c1090a63767" />
<img width="795" height="847" alt="image" src="https://github.com/user-attachments/assets/c0186a4a-a150-4159-b394-c1d6113c1aed" />
<br>
Setelah Dimodifikasi (Tugas1_biodata.php):
<img width="1902" height="946" alt="image" src="https://github.com/user-attachments/assets/13e98e88-5d27-4994-870d-e5a36c8a8738" />
<img width="1033" height="1436" alt="image" src="https://github.com/user-attachments/assets/90316841-b311-4e2e-a6c1-0ccbb7aa0e48" />
<br>
Penjelasan 5 Bagian Kode Paling Penting:<br>
1. Definisi Fungsi statusKelulusan() dengan Type Hinting Fungsi ini menerima masukan berupa angka desimal (IPK) dan mengembalikan nilai berupa teks. Logika percabangan bertingkat digunakan untuk menentukan predikat akademik mahasiswa secara otomatis, termasuk penambahan predikat 'Dengan Pujian (Cumlaude)' untuk IPK 3.75 ke atas.

2. Fungsi Baru cekKelayakanBeasiswa() (Kondisi Majemuk) Fungsi tambahan yang mengevaluasi dua syarat sekaligus menggunakan operator logika DAN (&&). Mahasiswa dinyatakan berhak mendapatkan beasiswa jika memenuhi dua kriteria secara bersamaan, yaitu memiliki IPK minimal 3.50 dan sudah menempuh minimal semester 2.

3. Struktur Data Array Asosiatif $mahasiswa dengan Nested Array Menyimpan seluruh atribut data mahasiswa dalam satu variabel berstruktur key-value. Penambahan field baru seperti email, status keaktifan, dan elemen hobi yang bertipe array di dalam array (nested array) membuat struktur data lebih lengkap.

4. Perulangan foreach dengan Pengecekan is_array() dan implode() Iterasi otomatis untuk menampilkan seluruh data biodata ke dalam daftar HTML. Kode mengecek tipe data pada setiap elemen: jika data berupa teks/angka biasa akan langsung ditampilkan, namun jika data berupa array (seperti hobi), data digabungkan terlebih dahulu menjadi teks berpemisah koma.

5. Sanitasi Data Output menggunakan htmlspecialchars() Fungsi keamanan wajib pada PHP yang mengubah karakter khusus menjadi bentuk aman HTML entity. Hal ini dilakukan untuk mencegah celah keamanan Cross-Site Scripting (XSS) saat menampilkan data variabel ke halaman web.

<br> 
Error yang Pernah Muncul, Penyebab, & Perbaikannya <br>
Error: Warning Array to string conversion

Penyebab: Terjadi ketika mencoba mencetak variabel bertipe array secara langsung menggunakan perintah echo tanpa mengonversinya terlebih dahulu.
Solusi: Gunakan fungsi implode() untuk menggabungkan elemen array menjadi teks string, atau gunakan pengecekan tipe data dengan is_array() sebelum data dicetak.

<br>

Tugas 2 <br>
Sebelum Dimodifikasi (identitas.php):
<img width="1916" height="990" alt="image" src="https://github.com/user-attachments/assets/88e599b5-ae82-4f9a-922b-face46490620" />
<img width="718" height="904" alt="image" src="https://github.com/user-attachments/assets/f469febe-a614-4a82-8bac-24c625c5286d" />
<br>
Setelah Dimodifikasi (Tugas2.php):
<img width="1909" height="988" alt="image" src="https://github.com/user-attachments/assets/de89b2d7-c42c-42be-83b9-4bdf9cb0e0b4" />
<img width="979" height="2082" alt="image" src="https://github.com/user-attachments/assets/018c4bec-2460-4e74-a7dd-4af34ad9e987" />
<br>
Penjelasan 5 Bagian Kode Paling Penting (Tugas2.php):<br>
1. Deklarasi Interface Identitas Mendefinisikan kontrak atau standar method wajib ringkasan() yang harus diimplementasikan oleh kelas Mahasiswa. Interface memastikan struktur method seragam pada kelas-kelas yang mengimplementasikannya.

2. Penerapan Enkapsulasi (Access Modifiers: private, protected, public) Prinsip Pemrograman Berorientasi Objek (OOP) untuk melindungi data. Properti seperti NIM dan Nama dibuat private agar hanya bisa diakses dari dalam kelas itu sendiri, sedangkan IPK dibuat protected agar bisa diakses oleh kelas turunan.

3. Penerapan Pewarisan Kelas / Inheritance (MahasiswaBeasiswa) Kelas MahasiswaBeasiswa mewarisi seluruh atribut dan method dari kelas induk Mahasiswa. Fitur ini memungkinkan pengembangan kelas baru dengan menambah atribut khusus (seperti jenis beasiswa) tanpa perlu menulis ulang kode dari awal.

4. Method Overriding dan Konstruktor Induk (parent::) Kelas anak menimpa ulang implementasi method ringkasan() dari kelas induk untuk memberikan format keluaran yang lebih spesifik. Konstruktor kelas anak juga memanggil parent::__construct() untuk menginisialisasi data dasar dari kelas induk.

5. Penanganan Error / Exception Handling (try-catch) Blok pengujian untuk menangkap kesalahan saat program berjalan. Jika terjadi kesalahan validasi nilai IPK (misalnya memasukkan IPK di luar rentang 0-4), program tidak akan crash melainkan menangkap kesalahan pada blok catch dan menampilkan pesan error yang ramah.
<br>

Error yang Pernah Muncul, Penyebab, & Perbaikannya <br>
Error: Fatal error: Class Mahasiswa contains 1 abstract method and must therefore be declared abstract or implement the remaining methods

Penyebab: Terjadi ketika sebuah kelas mengimplementasikan sebuah Interface, namun lupa mendefinisikan method yang diwajibkan oleh interface tersebut.
Solusi: Pastikan seluruh method yang ada di dalam interface (misalnya method ringkasan) diimplementasikan secara lengkap di dalam kelas.

Sebelum Dimodifikasi (hitung.php)
<img width="1910" height="999" alt="image" src="https://github.com/user-attachments/assets/b2cf64ab-7645-49ff-8400-896e6c1808e5" />
<img width="579" height="1170" alt="image" src="https://github.com/user-attachments/assets/3e6e2b85-7189-4514-af8e-533ee80e9f3d" />
<br>
Setelah Dimodifikasi (Tugas2_hitung.php):
<img width="1908" height="983" alt="image" src="https://github.com/user-attachments/assets/57f7c024-1aec-4bdd-a941-a15e41531bc0" />
<img width="1156" height="2500" alt="image" src="https://github.com/user-attachments/assets/500fa6a8-74d7-451c-9454-145e16c78c7b" />
<br>
Penjelasan 5 Bagian Kode Paling Penting:<br>
1. Interface BisaDihitung Menentukan standar atau kontrak method wajib hargaAkhir() yang mengembalikan nilai desimal (float). Interface ini menjamin bahwa setiap kelas produk yang dibuat pasti memiliki fungsi untuk mengkalkulasi harga akhir.

2. Kelas Induk Produk dengan Validasi Harga Menggunakan fitur PHP modern Constructor Property Promotion dengan hak akses protected agar variabel dapat diakses oleh kelas turunan. Konstruktor juga dilengkapi validasi untuk memastikan harga produk tidak boleh bernilai negatif.

3. Kelas Turunan ProdukDiskon dan Method getHemat() Mewarisi seluruh sifat dari kelas Produk dan menimpa ulang kalkulasi harga akhir dengan memperhitungkan persentase diskon. Terdapat method tambahan getHemat() untuk menghitung besaran nominal rupiah potongan harga yang didapatkan.

4. Kelas Baru ProdukPajak (Penerapan Polimorfisme) Kelas turunan baru yang menghitung harga akhir dengan menambahkan Pajak Pertambahan Nilai (PPN 11%). Ini menunjukkan penerapan polimorfisme, di mana method hargaAkhir() memiliki perilaku perhitungan yang berbeda-beda di setiap kelas.

5. Kalkulasi Akumulasi Total Transaksi dan Tampilan HTML Perulangan foreach yang melakukan iterasi pada daftar produk untuk menghitung akumulasi total biaya transaksi belanja. Tampilan dibuat menurun ke bawah secara rapi di web browser dengan memanfaatkan tag HTML <br> dan pembatas angka ribuan.
<br>

Error: Uncaught InvalidArgumentException (Validasi Harga / Diskon Gagal)

Penyebab: Terjadi saat membuat objek ProdukDiskon atau Produk dengan memasukkan nilai masukan yang tidak valid (misalnya nilai diskon negatif atau di atas 100%).
Solusi: Bungkus proses pembuatan objek di dalam blok try-catch untuk menangkap pesan kesalahan, atau pastikan nilai masukan diskon selalu berada pada rentang 0% hingga 100%.





