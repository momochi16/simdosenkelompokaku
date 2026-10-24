<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkRole('admin');

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO dosen (nomor_registrasi, nuptk, nama, nip, jabatan_fungsional, kepangkatan, pendidikan_terakhir, rumpun_ilmu, status_serdos, status_pegawai, ikatan_kerja, status_aktivitas, penempatan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nomor_registrasi'],
            $_POST['nuptk'],
            $_POST['nama'],
            $_POST['nip'],
            $_POST['jabatan_fungsional'],
            $_POST['kepangkatan'],
            $_POST['pendidikan_terakhir'],
            $_POST['rumpun_ilmu'],
            $_POST['status_serdos'],
            $_POST['status_pegawai'],
            $_POST['ikatan_kerja'],
            $_POST['status_aktivitas'],
            $_POST['penempatan']
        ]);
        $success = "Data dosen berhasil ditambahkan!";
    } catch (PDOException $e) {
        $error = "Gagal menambahkan data: " . $e->getMessage();
    }
}
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Tambah Dosen Baru</h5>
                <a href="dosen_list.php" class="btn btn-sm btn-light border"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            </div>
            <div class="card-body">
                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i><?php echo $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nomor Registrasi</label>
                            <input type="text" name="nomor_registrasi" class="form-control" placeholder="Contoh: REG001">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NUPTK</label>
                            <input type="text" name="nuptk" class="form-control" placeholder="Nomor Unik Pendidik & Tenaga Kependidikan">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" required placeholder="Nama Lengkap beserta gelar">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsional" class="form-control" placeholder="Contoh: Lektor Kepala">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kepangkatan</label>
                            <input type="text" name="kepangkatan" class="form-control" placeholder="Contoh: Pembina / IVa">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="form-select">
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Rumpun Ilmu</label>
                            <input type="text" name="rumpun_ilmu" class="form-control" placeholder="Contoh: Informatika">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Status Serdos</label>
                            <select name="status_serdos" class="form-select">
                                <option value="Sudah Sertifikasi">Sudah Sertifikasi</option>
                                <option value="Belum Sertifikasi">Belum Sertifikasi</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Status Pegawai</label>
                            <input type="text" name="status_pegawai" class="form-control" placeholder="Contoh: PNS DPK">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Ikatan Kerja</label>
                            <input type="text" name="ikatan_kerja" class="form-control" placeholder="Contoh: Dosen Tetap">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Status Aktivitas</label>
                            <select name="status_aktivitas" class="form-select">
                                <option value="Aktif">Aktif</option>
                                <option value="Cuti">Cuti</option>
                                <option value="Tugas Belajar">Tugas Belajar</option>
                                <option value="Keluar">Keluar</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-semibold">Penempatan (Prodi/Fakultas)</label>
                            <input type="text" name="penempatan" class="form-control" placeholder="Contoh: Teknik Informatika">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                        <button type="reset" class="btn btn-light border">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Data Dosen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
