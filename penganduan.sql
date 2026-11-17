-- Buat dan gunakan basis data
CREATE DATABASE IF NOT EXISTS e_pemerintahan;
USE e_pemerintahan;

-- Hapus tabel jika sudah ada untuk pengaturan ulang yang bersih
DROP TABLE IF EXISTS pengaduan;

CREATE TABLE pengaduan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_tiket VARCHAR(10) NOT NULL UNIQUE,
    nik VARCHAR(16) NOT NULL,
    nama_warga VARCHAR(100) NOT NULL,
    kategori ENUM('Infrastruktur', 'Pelayanan', 'Keamanan', 'Lainnya') NOT NULL,
    lokasi TEXT NOT NULL,
    deskripsi TEXT NOT NULL,
    status ENUM('Pending', 'Diproses', 'Selesai') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Masukkan data contoh awal (Opsional untuk pengujian)
INSERT INTO pengaduan (kode_tiket, nik, nama_warga, kategori, lokasi, deskripsi, status) 
VALUES 
