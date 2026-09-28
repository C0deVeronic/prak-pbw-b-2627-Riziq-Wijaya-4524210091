<?php
// Tugas1_identitas.php - Modifikasi Identitas (OOP PHP) dari identitas.php
// Modifikasi yang diterapkan:
// 1. Inheritance (Pewarisan): Class MahasiswaBeasiswa turunan dari Mahasiswa
// 2. Method Baru & Overriding: Method predikat() dan method overriding ringkasan()
// 3. Handling Exception: Penggunaan try-catch untuk menangkap InvalidArgumentException IPK

interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    protected float $ipk;

    public function __construct(string $nim, string $nama, float $ipk)
    {
        if (empty(trim($nama))) {
            throw new InvalidArgumentException('Nama tidak boleh kosong.');
        }
        $this->nim = $nim;
        $this->nama = $nama;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus berada di rentang 0 sampai 4.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    public function getNim(): string
    {
        return $this->nim;
    }

    public function getNama(): string
    {
        return $this->nama;
    }

    // Modifikasi 2: Method Baru Predikat
    public function predikat(): string
    {
        if ($this->ipk >= 3.75) return 'Cumlaude';
        if ($this->ipk >= 3.50) return 'Sangat Memuaskan';
        if ($this->ipk >= 3.00) return 'Memuaskan';
        return 'Perlu Peningkatan';
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - ' . $this->nama . ' - IPK: ' . $this->ipk . ' (' . $this->predikat() . ')';
    }
}

// Modifikasi 1: Class Turunan (Inheritance)
class MahasiswaBeasiswa extends Mahasiswa
{
    private string $jenisBeasiswa;

    public function __construct(string $nim, string $nama, float $ipk, string $jenisBeasiswa)
    {
        parent::__construct($nim, $nama, $ipk);
        $this->jenisBeasiswa = $jenisBeasiswa;
    }

    // Method Overriding
    public function ringkasan(): string
    {
        return parent::ringkasan() . ' [Penerima Beasiswa: ' . $this->jenisBeasiswa . ']';
    }
}

// Modifikasi 3: Penanganan Error (Try-Catch Exception Handling)
try {
    echo "--- Data Mahasiswa Reguler ---\n";
    $mhs1 = new Mahasiswa('4524210091', 'Riziq Wijaya', 3.85);
    echo $mhs1->ringkasan() . "\n\n";

    echo "--- Data Mahasiswa Beasiswa ---\n";
    $mhs2 = new MahasiswaBeasiswa('4524210092', 'Andi Pratama', 3.90, 'Beasiswa Unggulan');
    echo $mhs2->ringkasan() . "\n\n";

    // Contoh Uji Coba Error (IPK Tidak Valid)
    echo "--- Pengujian Validasi IPK Salah ---\n";
    $mhsError = new Mahasiswa('4524210093', 'Budi', 4.5); // Akan memicu Exception
} catch (InvalidArgumentException $e) {
    echo 'Terjadi Error: ' . $e->getMessage() . "\n";
}
