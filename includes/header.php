<?php
require_once 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM Dosen - UM Bengkulu</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <h5 class="mb-0 fw-bold">SIM DOSEN</h5>
                <small class="opacity-75">UM Bengkulu</small>
            </div>

            <ul class="list-unstyled components">
                <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                    <a href="dashboard.php">
                        <i class="bi bi-grid-fill"></i> Dashboard
                    </a>
                </li>
                <li class="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['dosen_list.php', 'dosen_add.php', 'dosen_edit.php', 'dosen_detail.php']) ? 'active' : ''; ?>">
                    <a href="dosen_list.php">
                        <i class="bi bi-people-fill"></i> Data Dosen
                    </a>
                </li>
                <?php if (isAdmin()): ?>
                <li class="<?php echo in_array(basename($_SERVER['PHP_SELF']), ['users_list.php', 'users_add.php', 'users_edit.php']) ? 'active' : ''; ?>">
                    <a href="users_list.php">
                        <i class="bi bi-person-badge-fill"></i> Manajemen User
                    </a>
                </li>
                <?php endif; ?>
                <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>">
                    <a href="laporan.php">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan
                    </a>
                </li>
                <li class="mt-4 pt-3 border-top border-secondary mx-3">
                    <a href="logout.php" class="text-danger opacity-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand-lg sticky-top">
                <div class="container-fluid px-0">
                    <button type="button" id="sidebarCollapse" class="btn btn-light d-md-none me-3">
                        <i class="bi bi-list"></i>
                    </button>
                    
                    <h5 class="mb-0 fw-semibold text-dark">
                        <?php 
                        $page = basename($_SERVER['PHP_SELF']);
                        switch($page) {
                            case 'dashboard.php': echo 'Dashboard'; break;
                            case 'dosen_list.php': echo 'Data Dosen'; break;
                            case 'dosen_add.php': echo 'Tambah Data Dosen'; break;
                            case 'dosen_edit.php': echo 'Edit Data Dosen'; break;
                            case 'dosen_detail.php': echo 'Detail Data Dosen'; break;
                            case 'users_list.php': echo 'Manajemen User'; break;
                            case 'users_add.php': echo 'Tambah User'; break;
                            case 'users_edit.php': echo 'Edit User'; break;
                            case 'laporan.php': echo 'Laporan Data Dosen'; break;
                            default: echo 'Sistem Informasi Dosen';
                        }
                        ?>
                    </h5>

                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="text-end me-3 d-none d-sm-block">
                                    <p class="mb-0 fw-bold small"><?php echo $_SESSION['nama_lengkap']; ?></p>
                                    <p class="mb-0 text-muted smaller"><?php echo ucfirst($_SESSION['role']); ?></p>
                                </div>
                                <div class="bg-soft-green rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="bi bi-person-fill text-success"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2"></i> Profil Saya</a></li>
                                <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2"></i> Pengaturan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
