<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkLogin();

$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan');
$stmt = $pdo->prepare("SELECT * FROM dosen WHERE id = ?");
$stmt->execute([$id]);
$d = $stmt->fetch();

if (!$d) die('Data tidak ditemukan');
?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card overflow-hidden">
            <div class="card-header bg-soft-green py-4 border-0 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm me-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-fill text-success display-4"></i>
                    </div>
                    <div>
                        <h3 class="mb-1 fw-bold text-deep-green"><?php echo $d['nama']; ?></h3>
                        <p class="mb-0 text-muted small"><i class="bi bi-geo-alt-fill me-1"></i> <?php echo $d['penempatan']; ?></p>
                    </div>
                </div>
                <div class="btn-group">
                    <a href="dosen_list.php" class="btn btn-light border btn-sm"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <?php if (isAdmin()): ?>
                    <a href="dosen_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil me-2"></i>Edit Profil</a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-6 border-end">
                        <div class="p-4">
                            <h6 class="text-uppercase text-muted smaller fw-bold mb-4">Informasi Identitas</h6>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Nomor Registrasi</label>
                                <div class="fw-semibold"><?php echo $d['nomor_registrasi'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">NUPTK</label>
                                <div class="fw-semibold"><?php echo $d['nuptk'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">NIP</label>
                                <div class="fw-semibold"><?php echo $d['nip'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Jabatan Fungsional</label>
                                <div class="fw-semibold text-primary-green"><?php echo $d['jabatan_fungsional'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small d-block">Kepangkatan</label>
                                <div class="fw-semibold"><?php echo $d['kepangkatan'] ?: '-'; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4">
                            <h6 class="text-uppercase text-muted smaller fw-bold mb-4">Informasi Akademik & Kepegawaian</h6>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Pendidikan Terakhir</label>
                                <span class="badge bg-soft-info"><?php echo $d['pendidikan_terakhir'] ?: '-'; ?></span>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Rumpun Ilmu</label>
                                <div class="fw-semibold"><?php echo $d['rumpun_ilmu'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Status Sertifikasi (Serdos)</label>
                                <span class="badge <?php echo strpos($d['status_serdos'], 'Sudah') !== false ? 'bg-soft-success' : 'bg-soft-warning'; ?>">
                                    <?php echo $d['status_serdos'] ?: '-'; ?>
                                </span>
                            </div>
                            <div class="mb-4">
                                <label class="text-muted small d-block">Ikatan Kerja</label>
                                <div class="fw-semibold"><?php echo $d['ikatan_kerja'] ?: '-'; ?></div>
                            </div>
                            <div class="mb-0">
                                <label class="text-muted small d-block">Status Aktivitas</label>
                                <span class="badge bg-soft-info"><?php echo $d['status_aktivitas'] ?: '-'; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light p-3 text-center border-0">
                <small class="text-muted italic">Terakhir diperbarui: <?php echo date('d M Y H:i', strtotime($d['updated_at'])); ?></small>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
