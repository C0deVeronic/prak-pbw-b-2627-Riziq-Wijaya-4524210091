# Pertemuan 7 - Program Penjualan Produk (Arsitektur MVC & MySQL)

Laporan dan dokumentasi pembuatan program penjualan produk sederhana menggunakan konsep arsitektur **MVC (Model, View, Controller)** yang terhubung dengan basis data **MySQL**.

---

## 1. Struktur Folder & Peran Masing-Masing File

Sistem dibuat dengan memisahkan kode program ke dalam layer MVC sesuai ketentuan:

```text
pertemuan7/
├── controller/
│   └── ProdukController.php    # Menghubungkan Model dan View serta mengatur alur proses program
├── model/
│   └── ProdukModel.php         # Berinteraksi langsung dengan database MySQL (CRUD produk)
├── view/
│   ├── create.php              # Tampilan formulir tambah produk
│   ├── edit.php                # Tampilan formulir ubah/edit produk
│   └── index.php               # Tampilan daftar/katalog produk (tabel & statistik)
├── index.php                   # Pintu masuk utama (Front Controller / Router) program
├── Tugas7.php                  # Entry point yang memanggil index.php
├── koneksi.php                 # Konfigurasi koneksi PHP ke database MySQL
├── database.sql                # Skrip SQL skema tabel dan data awal
└── README.md                   # Dokumentasi program
```

### Penjelasan Komponen:
1. **Model (`model/ProdukModel.php`)**:
   - Mengelola data produk dan berinteraksi langsung dengan database MySQL.
   - Menyediakan method `getAll()`, `getById()`, `tambahProduk()`, `updateProduk()`, `hapusProduk()`, dan `getStatistik()`.

2. **View (`view/index.php`, `view/create.php`, `view/edit.php`)**:
   - Menampilkan halaman daftar produk, form tambah produk, dan form edit produk.
   - Dibangun menggunakan Tailwind CSS yang responsif dan rapi.

3. **Controller (`controller/ProdukController.php`)**:
   - Menghubungkan Model dengan View serta mengatur proses program.
   - Mengatur aksi: `index()`, `create()`, `store()`, `edit()`, `update()`, dan `delete()`.

4. **Router (`index.php`)**:
   - Pintu masuk utama untuk menjalankan program.
   - Mengarahkan request berdasarkan parameter `aksi`.

5. **Koneksi (`koneksi.php`)**:
   - Menghubungkan PHP dengan MySQL.

---

## 2. Skema Database & Tabel

### Database: `db_penjualan`
### Tabel: `produk`

| Nama Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `INT` | Primary Key, Auto Increment |
| `nama_produk` | `VARCHAR(150)` | Nama barang / produk penjualan |
| `harga` | `DECIMAL(12, 2)` | Harga satuan produk |
| `stok` | `INT` | Jumlah kuantitas stok produk |
| `created_at` | `TIMESTAMP` | Waktu pencatatan produk |

Skrip SQL:
```sql
CREATE DATABASE IF NOT EXISTS `db_penjualan`;
USE `db_penjualan`;

CREATE TABLE IF NOT EXISTS `produk` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_produk` VARCHAR(150) NOT NULL,
    `harga` DECIMAL(12, 2) NOT NULL,
    `stok` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 3. Fitur Program

1. **Menampilkan Daftar Produk**: Menampilkan seluruh data produk dalam tabel terstruktur beserta format mata uang Rupiah dan status stok.
2. **Pencarian Produk**: Mencari produk berdasarkan nama produk.
3. **Menambahkan Data Produk**: Menyimpan data produk baru ke tabel MySQL.
4. **Mengedit Data Produk**: Memperbarui informasi produk yang telah ada.
5. **Menghapus Data Produk**: Menghapus data produk dengan konfirmasi.

---

## 4. Cara Menjalankan Program

1. Aktifkan modul Apache dan MySQL pada XAMPP Control Panel.
2. Akses melalui browser:
   - `http://localhost/pertemuan1/pertemuan7/` atau
   - `http://localhost/pertemuan1/pertemuan7/Tugas7.php`
