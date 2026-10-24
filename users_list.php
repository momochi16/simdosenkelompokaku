<?php
require_once 'config/db.php';
require_once 'includes/header.php';
checkRole('admin');

$stmt = $pdo->query("SELECT * FROM users ORDER BY username ASC");
$users = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pengguna Sistem</h5>
        <a href="users_add.php" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-2"></i> Tambah User
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center" width="60">No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Hak Akses / Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-soft-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px;">
                                    <i class="bi bi-person-circle text-info"></i>
                                </div>
                                <span class="fw-bold"><?php echo htmlspecialchars($u['username']); ?></span>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($u['nama_lengkap']); ?></td>
                        <td>
                            <?php 
                            $badgeClass = 'bg-soft-info';
                            if($u['role'] == 'admin') $badgeClass = 'bg-soft-success';
                            if($u['role'] == 'pimpinan') $badgeClass = 'bg-soft-warning';
                            ?>
                            <span class="badge <?php echo $badgeClass; ?> text-uppercase">
                                <?php echo htmlspecialchars($u['role']); ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="users_edit.php?id=<?php echo $u['id']; ?>" class="btn btn-sm btn-light border" title="Edit"><i class="bi bi-pencil text-warning"></i></a>
                                <?php if ($u['username'] != 'admin'): ?>
                                <a href="users_delete.php?id=<?php echo $u['id']; ?>" class="btn btn-sm btn-light border" title="Hapus" onclick="return confirm('Hapus user ini?')"><i class="bi bi-trash text-danger"></i></a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
