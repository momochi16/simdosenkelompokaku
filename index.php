<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM Dosen - Universitas Muhammadiyah Bengkulu</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --deep-green: #166534;
            --primary-green: #15803D;
            --soft-green: #DCFCE7;
            --bg-color: #F8FAFC;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
        }
        .hero-section {
            background: linear-gradient(rgba(22, 101, 52, 0.7), rgba(22, 101, 52, 0.7)), url('assets/img/umb.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--deep-green) !important;
        }
        .btn-success {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-success:hover {
            background-color: var(--deep-green);
            border-color: var(--deep-green);
        }
        .card {
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: var(--soft-green);
            color: var(--primary-green);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" href="#">SIM DOSEN UMB</a>
            <div class="ms-auto">
                <a href="login.php" class="btn btn-success shadow-sm">Login Sistem</a>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Sistem Informasi Manajemen Dosen</h1>
            <p class="lead mb-5 opacity-90">Fakultas Teknik - Universitas Muhammadiyah Bengkulu</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <p class="mb-4">Platform terintegrasi untuk pengelolaan data akademik, profil, kepangkatan, dan sertifikasi dosen secara efisien dan transparan.</p>
                </div>
            </div>
            <a href="login.php" class="btn btn-lg btn-outline-light mt-3 px-5 py-3 fw-bold">Mulai Sekarang</a>
        </div>
    </header>

    <section class="py-5">
        <div class="container py-5 text-center">
            <h2 class="fw-bold mb-2">Fitur Utama</h2>
            <p class="text-muted mb-5">Layanan unggulan untuk mendukung produktivitas dosen</p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h4 class="fw-bold">Manajemen Data</h4>
                        <p class="text-muted small">Pengelolaan profil lengkap dosen mulai dari NIP, NUPTK, hingga riwayat pendidikan dalam satu platform.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <h4 class="fw-bold">Sertifikasi & Jabfung</h4>
                        <p class="text-muted small">Pemantauan status sertifikasi dosen (Serdos) dan jenjang jabatan fungsional akademik secara realtime.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-4">
                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        </div>
                        <h4 class="fw-bold">Pelaporan Digital</h4>
                        <p class="text-muted small">Kemudahan dalam menghasilkan laporan aktif dosen yang akurat untuk kebutuhan administratif fakultas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-top py-5 text-center">
        <div class="container">
            <p class="mb-0 text-muted small">&copy; 2026 Universitas Muhammadiyah Bengkulu. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
