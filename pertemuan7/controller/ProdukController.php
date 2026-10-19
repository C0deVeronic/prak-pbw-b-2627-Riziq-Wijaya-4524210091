<?php
require_once __DIR__ . '/../model/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new ProdukModel($koneksi);
    }

    public function index() {
        $cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';
        $daftar_produk = $this->model->getAll($cari);
        $statistik = $this->model->getStatistik();
        include __DIR__ . '/../view/index.php';
    }

    public function create() {
        $error = $_GET['error'] ?? null;
        include __DIR__ . '/../view/create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_produk = trim($_POST['nama_produk'] ?? '');
            $harga       = (float) ($_POST['harga'] ?? 0);
            $stok        = (int) ($_POST['stok'] ?? 0);

            if (empty($nama_produk) || $harga < 0 || $stok < 0) {
                header("Location: index.php?aksi=create&error=input_tidak_valid");
                exit;
            }

            if ($this->model->tambahProduk($nama_produk, $harga, $stok)) {
                header("Location: index.php?pesan=tambah_sukses");
            } else {
                header("Location: index.php?aksi=create&error=gagal_simpan");
            }
            exit;
        }
        header("Location: index.php?aksi=create");
        exit;
    }

    public function edit() {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $produk = $this->model->getById($id);

        if (!$produk) {
            header("Location: index.php?pesan=tidak_ditemukan");
            exit;
        }

        $error = $_GET['error'] ?? null;
        include __DIR__ . '/../view/edit.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id          = (int) ($_POST['id'] ?? 0);
            $nama_produk = trim($_POST['nama_produk'] ?? '');
            $harga       = (float) ($_POST['harga'] ?? 0);
            $stok        = (int) ($_POST['stok'] ?? 0);

            if ($id <= 0 || empty($nama_produk) || $harga < 0 || $stok < 0) {
                header("Location: index.php?aksi=edit&id=$id&error=input_tidak_valid");
                exit;
            }

            if ($this->model->updateProduk($id, $nama_produk, $harga, $stok)) {
                header("Location: index.php?pesan=edit_sukses");
            } else {
                header("Location: index.php?aksi=edit&id=$id&error=gagal_update");
            }
            exit;
        }
        header("Location: index.php");
        exit;
    }

    public function delete() {
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        if ($id > 0) {
            $this->model->hapusProduk($id);
            header("Location: index.php?pesan=hapus_sukses");
        } else {
            header("Location: index.php");
        }
        exit;
    }
}
?>
