CREATE DATABASE IF NOT EXISTS sim_dosen;
USE sim_dosen;

-- Drop tables if exists to ensure clean structure
DROP TABLE IF EXISTS dosen;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    role ENUM('admin', 'pimpinan', 'dosen') NOT NULL DEFAULT 'dosen',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE dosen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_registrasi VARCHAR(50),
    nuptk VARCHAR(50),
    nama VARCHAR(150) NOT NULL,
    nip VARCHAR(50),
    jabatan_fungsional VARCHAR(100),
    kepangkatan VARCHAR(100),
    pendidikan_terakhir VARCHAR(50),
    rumpun_ilmu VARCHAR(100),
    status_serdos VARCHAR(50),
    status_pegawai VARCHAR(50),
    ikatan_kerja VARCHAR(50),
    status_aktivitas VARCHAR(50),
    penempatan VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Default users
-- admin / admin123
INSERT INTO users (username, password, nama_lengkap, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin'),
('pimpinan', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Pimpinan UM Bengkulu', 'pimpinan');

-- Sample Data Dosen
INSERT INTO dosen (nomor_registrasi, nuptk, nama, nip, jabatan_fungsional, kepangkatan, pendidikan_terakhir, rumpun_ilmu, status_serdos, status_pegawai, ikatan_kerja, status_aktivitas, penempatan) VALUES
('REG001', 'NUPTK001', 'Dr. Budi Santoso, M.Kom', '198001012005011001', 'Lektor Kepala', 'Pembina / IVa', 'S3', 'Informatika', 'Sudah Sertifikasi', 'PNS DPK', 'Dosen Tetap', 'Aktif', 'Teknik Informatika'),
('REG002', 'NUPTK002', 'Siti Aminah, M.T', '198502022010022001', 'Lektor', 'Penata / IIIc', 'S2', 'Sistem Informasi', 'Belum Sertifikasi', 'Tetap Yayasan', 'Dosen Tetap', 'Aktif', 'Teknik Informatika');
