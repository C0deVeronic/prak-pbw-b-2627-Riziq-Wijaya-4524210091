<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Modul Mahasiswa') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .table thead th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.85rem;
            border-color: #cbd5e1;
        }
        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.15);
        }
        footer {
            margin-top: auto;
            border-top: 1px solid #e2e8f0;
            background: #ffffff;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('mahasiswa') ?>">
                <i class="bi bi-mortarboard-fill fs-4"></i>
                <span>SIAKAD <strong>PBW</strong></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '' || uri_string() == 'mahasiswa') ? 'active fw-semibold' : '' ?>" href="<?= base_url('mahasiswa') ?>">
                            <i class="bi bi-people-fill me-1"></i> Data Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'mahasiswa/tambah') ? 'active fw-semibold' : '' ?>" href="<?= base_url('mahasiswa/tambah') ?>">
                            <i class="bi bi-person-plus-fill me-1"></i> Tambah Mahasiswa
                        </a>
                    </li>
                </ul>
                <span class="navbar-text text-white-50 small">
                    <i class="bi bi-database me-1"></i> Database: <strong>akademik1</strong>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="py-3 text-center text-muted small">
        <div class="container">
            &copy; <?= date('Y') ?> Modul Mahasiswa - CodeIgniter 4 | Tugas Pemrograman Berbasis Web
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
