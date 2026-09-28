<?php
// Tugas2_hitung.php - Modifikasi Perhitungan Produk (OOP PHP) dari hitung.php
// Modifikasi yang diterapkan:
// 1. Interface & Class Baru: Penambahan class ProdukPajak dan ProdukGrosir
// 2. Method & Fitur Baru: Method getHemat(), getDetail(), dan kalkulasi Total Transaksi
// 3. Validasi & Format Browser: Validasi harga/diskon dan tampilan rapi dengan tag <br>

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga
    ) {
        if ($harga < 0) {
            throw new InvalidArgumentException("Harga produk tidak boleh negatif.");
        }
    }

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    public function getHarga(): float
    {
        return $this->harga;
    }

    public function getHemat(): float
    {
        return 0; // Produk standar tidak ada penghematan
    }

    public function getDetail(): string
    {
        return $this->nama . " - Harga Normal: Rp " . number_format($this->harga, 0, ',', '.');
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(
        string $nama,
        float $harga,
        private float $diskon
    ) {
        if ($diskon < 0 || $diskon > 100) {
            throw new InvalidArgumentException("Persentase diskon harus di antara 0% - 100%.");
        }
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }

    // Modifikasi 2: Method Menghitung Besaran Hemat
    public function getHemat(): float
    {
        return $this->harga * ($this->diskon / 100);
    }

    public function getDetail(): string
    {
        return $this->nama . " - Diskon " . $this->diskon . "% (Hemat: Rp " . number_format($this->getHemat(), 0, ',', '.') . ")";
    }
}

// Modifikasi 1: Class Baru ProdukPajak (Termasuk PPN)
class ProdukPajak extends Produk
{
    public function __construct(
        string $nama,
        float $harga,
        private float $pajakPpn = 11 // PPN standar 11%
    ) {
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 + $this->pajakPpn / 100);
    }

    public function getDetail(): string
    {
        return $this->nama . " - Plus PPN " . $this->pajakPpn . "%";
    }
}

// Pengujian dan Tampilan Output
$daftar = [
    new Produk('Keyboard Mechanical', 250000),
    new ProdukDiskon('Mouse Gaming', 150000, 15),
    new ProdukPajak('Monitor 24 Inch', 1800000, 11),
    new ProdukDiskon('Headset Bluetooth', 300000, 20)
];

$totalTransaksi = 0;

echo "<strong>--- DAFTAR HARGA PRODUK (TUGAS 2) ---</strong><br><br>";

foreach ($daftar as $index => $produk) {
    $hargaAkhir = $produk->hargaAkhir();
    $totalTransaksi += $hargaAkhir;

    echo ($index + 1) . ". " . htmlspecialchars($produk->getDetail()) . "<br>";
    echo "&nbsp;&nbsp;&nbsp;<strong>Harga Akhir: Rp " . number_format($hargaAkhir, 0, ',', '.') . "</strong><br><br>";
}

echo "----------------------------------------<br>";
echo "<strong>TOTAL KESELURUHAN TRANSAKSI: Rp " . number_format($totalTransaksi, 0, ',', '.') . "</strong><br>";
