<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<?php
    $errors = session('errors') ?? [];
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Breadcrumb / Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-pencil-square text-warning me-2"></i>Ubah Data Mahasiswa
                </h3>
                <p class="text-muted mb-0 small">Perbarui data mahasiswa NIM <strong><?= esc($mahasiswa['nim']) ?></strong></p>
            </div>
            <a href="<?= base_url('mahasiswa') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <!-- Alert Ringkasan Pesan Kesalahan Validasi -->
        <?php if (! empty($errors)) : ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <strong>Peringatan Validasi: Mohon perbaiki data input berikut!</strong>
                </div>
                <ul class="mb-0 ps-3">
                    <?php foreach ($errors as $field => $errorMsg) : ?>
                        <li><?= esc($errorMsg) ?></li>
                    <?php endforeach ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>

        <!-- Card Form Ubah Data -->
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= base_url('mahasiswa/update/' . $mahasiswa['nim']) ?>" method="post" novalidate>
                    <?= csrf_field() ?>

                    <!-- NIM -->
                    <div class="mb-3">
                        <label for="nim" class="form-label fw-semibold">
                            Nomor Induk Mahasiswa (NIM) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" 
                                   name="nim" 
                                   id="nim" 
                                   class="form-control <?= isset($errors['nim']) ? 'is-invalid' : '' ?>" 
                                   placeholder="Contoh: 4524210091" 
                                   value="<?= esc(old('nim', $mahasiswa['nim'])) ?>" 
                                   required>
                            <?php if (isset($errors['nim'])) : ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-x-circle me-1"></i><?= esc($errors['nim']) ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-text text-muted">NIM mahasiswa (angka 5-20 karakter).</div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-semibold">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   name="nama" 
                                   id="nama" 
                                   class="form-control <?= isset($errors['nama']) ? 'is-invalid' : '' ?>" 
                                   placeholder="Contoh: Budi Santoso" 
                                   value="<?= esc(old('nama', $mahasiswa['nama'])) ?>" 
                                   required>
                            <?php if (isset($errors['nama'])) : ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-x-circle me-1"></i><?= esc($errors['nama']) ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Alamat Email <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                   placeholder="Contoh: budi.santoso@kampus.ac.id" 
                                   value="<?= esc(old('email', $mahasiswa['email'])) ?>" 
                                   required>
                            <?php if (isset($errors['email'])) : ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-x-circle me-1"></i><?= esc($errors['email']) ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-3">
                        <label for="prodi" class="form-label fw-semibold">
                            Program Studi <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-building"></i></span>
                            <select name="prodi" 
                                    id="prodi" 
                                    class="form-select <?= isset($errors['prodi']) ? 'is-invalid' : '' ?>" 
                                    required>
                                <option value="">-- Pilih Program Studi --</option>
                                <?php
                                    $daftarProdi = [
                                        'Teknik Informatika',
                                        'Sistem Informasi',
                                        'Teknik Elektro',
                                        'Teknik Mesin',
                                        'Teknik Sipil',
                                        'Teknik Industri',
                                    ];
                                    $selectedProdi = old('prodi', $mahasiswa['prodi']);
                                ?>
                                <?php foreach ($daftarProdi as $prodiItem) : ?>
                                    <option value="<?= esc($prodiItem) ?>" <?= ($selectedProdi === $prodiItem) ? 'selected' : '' ?>>
                                        <?= esc($prodiItem) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <?php if (isset($errors['prodi'])) : ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-x-circle me-1"></i><?= esc($errors['prodi']) ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Angkatan -->
                        <div class="col-md-6 mb-3">
                            <label for="angkatan" class="form-label fw-semibold">
                                Tahun Angkatan <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                                <input type="number" 
                                       name="angkatan" 
                                       id="angkatan" 
                                       class="form-control <?= isset($errors['angkatan']) ? 'is-invalid' : '' ?>" 
                                       placeholder="Contoh: 2024" 
                                       min="2000" 
                                       max="2030" 
                                       value="<?= esc(old('angkatan', $mahasiswa['angkatan'])) ?>" 
                                       required>
                                <?php if (isset($errors['angkatan'])) : ?>
                                    <div class="invalid-feedback">
                                        <i class="bi bi-x-circle me-1"></i><?= esc($errors['angkatan']) ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <!-- IPK -->
                        <div class="col-md-6 mb-3">
                            <label for="ipk" class="form-label fw-semibold">
                                IPK (Indeks Prestasi Kumulatif) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-award"></i></span>
                                <input type="number" 
                                       step="0.01" 
                                       min="0.00" 
                                       max="4.00" 
                                       name="ipk" 
                                       id="ipk" 
                                       class="form-control <?= isset($errors['ipk']) ? 'is-invalid' : '' ?>" 
                                       placeholder="Contoh: 3.75" 
                                       value="<?= esc(old('ipk', $mahasiswa['ipk'])) ?>" 
                                       required>
                                <?php if (isset($errors['ipk'])) : ?>
                                    <div class="invalid-feedback">
                                        <i class="bi bi-x-circle me-1"></i><?= esc($errors['ipk']) ?>
                                    </div>
                                <?php endif ?>
                            </div>
                            <div class="form-text text-muted">Rentang nilai: 0.00 s/d 4.00.</div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?= base_url('mahasiswa') ?>" class="btn btn-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning px-4 text-dark fw-semibold shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
