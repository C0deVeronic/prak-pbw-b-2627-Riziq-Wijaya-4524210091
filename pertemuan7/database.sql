-- Database: db_penjualan
-- Tugas 7 Pemrograman Berbasis Web: Program Penjualan Produk MVC

-- 1. Membuat Database jika belum ada
CREATE DATABASE IF NOT EXISTS `db_penjualan` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_penjualan`;

-- 2. Menghapus tabel lama jika ingin reset
-- DROP TABLE IF EXISTS `produk`;

-- 3. Membuat Tabel produk
CREATE TABLE IF NOT EXISTS `produk` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nama_produk` VARCHAR(150) NOT NULL,
    `harga` DECIMAL(12, 2) NOT NULL,
    `stok` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Contoh Data Awal (Dummy Data)
INSERT INTO `produk` (`nama_produk`, `harga`, `stok`) VALUES
('Laptop ASUS Vivobook 14', 8500000.00, 12),
('Mouse Wireless Logitech M330', 225000.00, 45),
('Keyboard Mechanical Keychron K2', 1350000.00, 18),
('Monitor Gaming LG 24 Inch 144Hz', 2150000.00, 8),
('Headset SteelSeries Arctis Nova 1', 780000.00, 25);
