<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="fw-bold text-dark mb-1">
            <i class="bi bi-people-fill text-primary me-2"></i>Daftar Mahasiswa
        </h3>
        <p class="text-muted mb-0 small">Pengelolaan data induk mahasiswa pada database <code>akademik1</code></p>
    </div>
    <a href="<?= base_url('mahasiswa/tambah') ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Mahasiswa
    </a>
</div>

<!-- Flash Message: Success -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill fs-5 me-2"></i>
            <div><?= session()->getFlashdata('success') ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<!-- Flash Message: Error -->
<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
            <div><?= session()->getFlashdata('error') ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <!-- Search and Filter Form -->
        <div class="row align-items-center mb-3 g-2">
            <div class="col-md-6">
                <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill">
                    Total Mahasiswa: <strong><?= count($mahasiswa) ?></strong>
                </span>
            </div>
            <div class="col-md-6">
                <form action="<?= base_url('mahasiswa') ?>" method="get" class="d-flex gap-2">
                    <input type="text" 
                           name="keyword" 
                           class="form-control form-control-sm" 
                           placeholder="Cari berdasarkan NIM, Nama, Prodi..." 
                           value="<?= esc($keyword ?? '') ?>">
                    <button type="submit" class="btn btn-sm btn-outline-primary px-3">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <?php if (! empty($keyword)) : ?>
                        <a href="<?= base_url('mahasiswa') ?>" class="btn btn-sm btn-outline-secondary" title="Reset Pencarian">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    <?php endif ?>
                </form>
            </div>
        </div>

        <!-- Table Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Program Studi</th>
                        <th class="text-center">Angkatan</th>
                        <th class="text-center">IPK</th>
                        <th style="width: 170px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($mahasiswa)) : ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Tidak ada data mahasiswa yang ditemukan.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($mahasiswa as $row) : ?>
                            <tr>
                                <td class="text-center fw-medium text-muted"><?= $no++ ?></td>
                                <td><span class="fw-bold font-monospace text-primary"><?= esc($row['nim']) ?></span></td>
                                <td class="fw-semibold text-dark"><?= esc($row['nama']) ?></td>
                                <td>
                                    <a href="mailto:<?= esc($row['email']) ?>" class="text-decoration-none text-secondary small">
                                        <i class="bi bi-envelope me-1"></i><?= esc($row['email']) ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= esc($row['prodi']) ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= esc($row['angkatan']) ?></td>
                                <td class="text-center">
                                    <?php
                                        $ipk = (float) $row['ipk'];
                                        $badgeClass = 'bg-secondary';
                                        if ($ipk >= 3.50) {
                                            $badgeClass = 'bg-success';
                                        } elseif ($ipk >= 3.00) {
                                            $badgeClass = 'bg-primary';
                                        } elseif ($ipk >= 2.50) {
                                            $badgeClass = 'bg-warning text-dark';
                                        } else {
                                            $badgeClass = 'bg-danger';
                                        }
                                    ?>
                                    <span class="badge <?= $badgeClass ?> font-monospace px-2 py-1">
                                        <?= number_format($ipk, 2) ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('mahasiswa/ubah/' . $row['nim']) ?>" 
                                           class="btn btn-outline-warning" 
                                           title="Ubah Data">
                                            <i class="bi bi-pencil-square"></i> Ubah
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalHapus<?= $row['nim'] ?>"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus<?= $row['nim'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['nim'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="modalLabel<?= $row['nim'] ?>">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start py-4">
                                                    <p class="mb-2">Apakah Anda yakin ingin menghapus data mahasiswa berikut?</p>
                                                    <div class="p-3 bg-light rounded border">
                                                        <div><strong>NIM:</strong> <?= esc($row['nim']) ?></div>
                                                        <div><strong>Nama:</strong> <?= esc($row['nama']) ?></div>
                                                        <div><strong>Prodi:</strong> <?= esc($row['prodi']) ?></div>
                                                    </div>
                                                    <p class="text-danger small mt-2 mb-0">
                                                        <i class="bi bi-info-circle me-1"></i>Tindakan ini tidak dapat dibatalkan.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a href="<?= base_url('mahasiswa/hapus/' . $row['nim']) ?>" class="btn btn-danger">
                                                        <i class="bi bi-trash-fill me-1"></i>Ya, Hapus Data
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
