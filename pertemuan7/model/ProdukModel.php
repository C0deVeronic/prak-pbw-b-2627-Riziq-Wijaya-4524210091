<?php
class ProdukModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // Mengambil semua data produk atau filter berdasarkan kata kunci
    public function getAll($keyword = '') {
        if (!empty($keyword)) {
            $keyword = "%" . $keyword . "%";
            $stmt = mysqli_prepare($this->db, "SELECT * FROM produk WHERE nama_produk LIKE ? ORDER BY id DESC");
            mysqli_stmt_bind_param($stmt, "s", $keyword);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            $result = mysqli_query($this->db, "SELECT * FROM produk ORDER BY id DESC");
        }

        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Mengambil satu data produk berdasarkan id
    public function getById($id) {
        $id = (int) $id;
        $stmt = mysqli_prepare($this->db, "SELECT * FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    // Menambah produk baru
    public function tambahProduk($nama_produk, $harga, $stok) {
        $stmt = mysqli_prepare($this->db, "INSERT INTO produk (nama_produk, harga, stok) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sdi", $nama_produk, $harga, $stok);
        return mysqli_stmt_execute($stmt);
    }

    // Memperbarui data produk
    public function updateProduk($id, $nama_produk, $harga, $stok) {
        $id = (int) $id;
        $stmt = mysqli_prepare($this->db, "UPDATE produk SET nama_produk = ?, harga = ?, stok = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "sdii", $nama_produk, $harga, $stok, $id);
        return mysqli_stmt_execute($stmt);
    }

    // Menghapus data produk
    public function hapusProduk($id) {
        $id = (int) $id;
        $stmt = mysqli_prepare($this->db, "DELETE FROM produk WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        return mysqli_stmt_execute($stmt);
    }

    // Mengambil ringkasan statistik produk
    public function getStatistik() {
        $query = "SELECT 
                    COUNT(*) AS total_produk, 
                    COALESCE(SUM(stok), 0) AS total_stok, 
                    COALESCE(SUM(harga * stok), 0) AS total_nilai 
                  FROM produk";
        $result = mysqli_query($this->db, $query);
        return $result ? mysqli_fetch_assoc($result) : ['total_produk' => 0, 'total_stok' => 0, 'total_nilai' => 0];
    }
}
?>
