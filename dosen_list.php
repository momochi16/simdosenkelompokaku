<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkLogin();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM dosen WHERE nama LIKE ? OR nip LIKE ? OR nuptk LIKE ? ORDER BY nama ASC";
$stmt = $pdo->prepare($query);
$stmt->execute(["%$search%", "%$search%", "%$search%"]);
$dosenList = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Dosen Aktif</h5>
        <?php if (isAdmin()): ?>
        <a href="dosen_add.php" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Tambah Dosen
        </a>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6 col-lg-4">
                <form method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama, NIP, atau NUPTK..." value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Profil Dosen</th>
                        <th>Jabatan & Pangkat</th>
                        <th>Pendidikan</th>
                        <th>Status Serdos</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($dosenList) > 0): ?>
                        <?php $no = 1; foreach ($dosenList as $d): ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-soft-green rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                        <i class="bi bi-person text-success"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold"><?php echo $d['nama']; ?></div>
                                        <div class="text-muted small">NIP: <?php echo $d['nip'] ?: '-'; ?></div>
                                        <div class="text-muted smaller">NUPTK: <?php echo $d['nuptk'] ?: '-'; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-primary-green"><?php echo $d['jabatan_fungsional'] ?: '-'; ?></div>
                                <div class="text-muted small"><?php echo $d['kepangkatan'] ?: '-'; ?></div>
                            </td>
                            <td>
                                <span class="badge bg-soft-info"><?php echo $d['pendidikan_terakhir'] ?: '-'; ?></span>
                            </td>
                            <td>
                                <?php if (strpos($d['status_serdos'], 'Sudah') !== false): ?>
                                    <span class="badge bg-soft-success"><i class="bi bi-check-circle-fill me-1"></i> <?php echo $d['status_serdos']; ?></span>
                                <?php else: ?>
                                    <span class="badge bg-soft-warning"><i class="bi bi-clock-history me-1"></i> <?php echo $d['status_serdos']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="dosen_detail.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-light border" title="Detail"><i class="bi bi-eye text-primary"></i></a>
                                    <?php if (isAdmin()): ?>
                                    <a href="dosen_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-light border" title="Edit"><i class="bi bi-pencil text-warning"></i></a>
                                    <a href="dosen_delete.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-light border" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="bi bi-trash text-danger"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox display-4 text-muted mb-3 d-block"></i>
                                <p class="text-muted">Data dosen tidak ditemukan</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
