# Modul Mahasiswa (CRUD & Validasi) - CodeIgniter 4
**Tugas Pemrograman Berbasis Web (Pertemuan 8)**

Modul CRUD data mahasiswa berbasis framework **CodeIgniter 4** yang terhubung langsung ke database **`akademik1`**, dilengkapi validasi input form menggunakan **Validation Rules CodeIgniter 4**, penanganan pesan kesalahan secara informatif pada view (alert summary dan inline form feedback), serta proteksi **CSRF Token** dan **XSS Escaping**.

---

## Fitur Utama
1. **Daftar Mahasiswa (Read)**
   - Menampilkan seluruh data mahasiswa dari tabel `mahasiswa` pada database `akademik1`.
   - Fitur pencarian data mahasiswa berdasarkan NIM, Nama, Program Studi, dll.
   - Pewarnaan badge IPK otomatis berdasarkan nilai prestasi (Hijau $\ge 3.50$, Biru $\ge 3.00$, Kuning $\ge 2.50$, Merah $< 2.50$).
   - Indikator total jumlah mahasiswa.
2. **Tambah Mahasiswa (Create)**
   - Formulir input data mahasiswa baru.
   - Validasi ketat menggunakan Validation Rules CI4.
   - Nilai input tetap tersimpan (`old()`) ketika validasi gagal sehingga pengguna tidak perlu mengisi ulang dari awal.
3. **Ubah Mahasiswa (Update)**
   - Formulir edit data mahasiswa dengan data awal yang otomatis terisi.
   - Pengecekan keunikan NIM dengan pengecualian terhadap data mahasiswa itu sendiri (`is_unique[mahasiswa.nim,nim,{nim}]`).
4. **Hapus Mahasiswa (Delete)**
   - Fitur hapus data mahasiswa dengan konfirmasi modal pop-up (mencegah klik tidak sengaja).
5. **Validasi Input & Pesan Kesalahan (Validation & Feedback)**
   - Tampilan ringkasan pesan kesalahan (*Alert Box* di bagian atas form).
   - Penandaan kolom input bermasalah (*border merah* `is-invalid`) dan pesan kesalahan tepat di bawah masing-masing elemen formulir (*inline feedback*).
   - Notifikasi sukses (*Flashdata Alert*) setelah operasi berhasil.

---

## Struktur Database (`akademik1`)

Tabel: `mahasiswa`

| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `nim` | `VARCHAR(20)` | Primary Key, Nomor Induk Mahasiswa |
| `nama` | `VARCHAR(100)` | Nama Lengkap Mahasiswa |
| `email` | `VARCHAR(100)` | Alamat Email Mahasiswa |
| `prodi` | `VARCHAR(100)` | Program Studi |
| `angkatan` | `INT(11)` | Tahun Angkatan (2000 - 2030) |
| `ipk` | `DECIMAL(3,2)` | Indeks Prestasi Kumulatif (0.00 - 4.00) |

---

## Aturan Validasi CI4 (Validation Rules)

| Kolom | Aturan Validasi | Pesan Kesalahan Kustom |
| :--- | :--- | :--- |
| **NIM** | `required`, `numeric`, `min_length[5]`, `max_length[20]`, `is_unique[mahasiswa.nim]` | - Wajib diisi<br>- Hanya boleh angka<br>- Minimal 5 karakter, maksimal 20 karakter<br>- NIM harus unik / belum terdaftar |
| **Nama** | `required`, `min_length[3]`, `max_length[100]` | - Wajib diisi<br>- Minimal 3 karakter, maksimal 100 karakter |
| **Email** | `required`, `valid_email`, `max_length[100]` | - Wajib diisi<br>- Format email harus valid |
| **Program Studi** | `required` | - Wajib dipilih dari daftar prodi |
| **Angkatan** | `required`, `numeric`, `exact_length[4]`, `greater_than_equal_to[2000]`, `less_than_equal_to[2030]` | - Wajib diisi<br>- Harus angka 4 digit<br>- Rentang tahun 2000 s/d 2030 |
| **IPK** | `required`, `numeric`, `greater_than_equal_to[0.00]`, `less_than_equal_to[4.00]` | - Wajib diisi<br>- Format angka/desimal<br>- Rentang nilai 0.00 s/d 4.00 |

---

## Struktur File Modul

```text
Tugas8/
├── app/
│   ├── Config/
│   │   ├── Database.php         # Konfigurasi database akademik1
│   │   └── Routes.php           # Rute modul mahasiswa
│   ├── Controllers/
│   │   └── Mahasiswa.php        # Controller CRUD & aturan validasi CI4
│   ├── Models/
│   │   └── MahasiswaModel.php   # Model database tabel mahasiswa
│   └── Views/
│       ├── layout/
│       │   └── template.php     # Layout template utama (Bootstrap 5)
│       └── mahasiswa/
│           ├── index.php        # Tampilan tabel daftar mahasiswa & modal hapus
│           ├── tambah.php       # Form tambah mahasiswa & penampil pesan validasi
│           └── ubah.php         # Form ubah mahasiswa & penampil pesan validasi
├── public/
│   └── index.php                # Front controller CodeIgniter 4
├── .env                         # Konfigurasi environment (DB, BaseURL)
├── .htaccess                    # URL rewrite Apache
└── index.php                    # Fallback entry point root XAMPP
```

## Screenshot Program
<img width="1902" height="993" alt="image" src="https://github.com/user-attachments/assets/4b33ab9e-c38d-49c5-9e68-3052cc358a60" />
<br>
<img width="1901" height="991" alt="image" src="https://github.com/user-attachments/assets/1d52e29f-7423-455f-ba50-5e2e8119f8ad" />
<br>
<img width="1904" height="987" alt="image" src="https://github.com/user-attachments/assets/c13516e3-79ce-40a2-a138-e40b1b9cec5d" />


