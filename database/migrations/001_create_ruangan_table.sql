-- ========================================
-- Create Table: ruangan
-- ========================================

CREATE TABLE ruangan (
    id_ruangan INT AUTO_INCREMENT PRIMARY KEY,
    nama_ruangan VARCHAR(100) NOT NULL,
    lantai INT NOT NULL,
    luas DECIMAL(10, 2) NOT NULL,
    kapasitas INT NOT NULL,
    status ENUM('aktif', 'maintenance') DEFAULT 'aktif',
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ========================================
-- Add Indexes for Performance
-- ========================================

-- Index untuk pencarian berdasarkan status
CREATE INDEX idx_ruangan_status ON ruangan(status);

-- Index untuk pencarian berdasarkan lantai
CREATE INDEX idx_ruangan_lantai ON ruangan(lantai);

-- Index untuk pencarian nama ruangan
CREATE INDEX idx_ruangan_nama ON ruangan(nama_ruangan);

-- ========================================
-- Insert Sample Data
-- ========================================

INSERT INTO ruangan (nama_ruangan, lantai, luas, kapasitas, status, deskripsi) VALUES
('Ruang Sidang A', 2, 50.00, 20, 'aktif', 'Ruangan sidang utama dengan fasilitas lengkap dan kapasitas 20 orang'),
('Ruang Sidang B', 2, 45.00, 18, 'aktif', 'Ruangan sidang cadangan dengan kapasitas 18 orang'),
('Ruang Tunggu', 1, 30.00, 15, 'maintenance', 'Ruang tunggu untuk pengunjung, sedang dalam perbaikan AC'),
('Ruang Rapat', 3, 25.00, 12, 'aktif', 'Ruangan rapat internal dengan kapasitas 12 orang'),
('Ruang Arsip', 1, 20.00, 5, 'aktif', 'Ruangan penyimpanan arsip penting dengan akses terbatas'),
('Break Room', 1, 15.00, 8, 'aktif', 'Ruangan istirahat karyawan dengan fasilitas pantry'),
('Ruang Konsultasi', 2, 18.00, 6, 'aktif', 'Ruangan konsultasi privasi dengan kapasitas terbatas'),
('Ruang Mediasi', 1, 22.00, 10, 'aktif', 'Ruangan mediasi untuk proses damai'),
('Ruang Sekretariat', 1, 12.00, 4, 'aktif', 'Ruang kerja sekretariat dan administrasi'),
('Ruang Perpustakaan', 2, 35.00, 25, 'aktif', 'Ruang perpustakaan dengan koleksi buku hukum dan referensi');

-- ========================================
-- Create View for Reporting
-- ========================================

CREATE VIEW v_ruangan_summary AS
SELECT 
    id_ruangan,
    nama_ruangan,
    lantai,
    luas,
    kapasitas,
    status,
    CASE 
        WHEN status = 'aktif' THEN 'green'
        WHEN status = 'maintenance' THEN 'orange'
        ELSE 'red'
    END as status_color,
    deskripsi,
    created_at,
    updated_at
FROM ruangan
ORDER BY nama_ruangan;
