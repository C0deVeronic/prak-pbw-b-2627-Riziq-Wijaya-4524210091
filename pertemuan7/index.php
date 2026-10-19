<?php
require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/controller/ProdukController.php';

$controller = new ProdukController($koneksi);
$aksi = $_GET['aksi'] ?? 'index';

switch ($aksi) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}
?>
