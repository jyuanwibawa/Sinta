-- Create table for pengerjaan
CREATE TABLE `pengerjaan` (
  `id_pengerjaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_ruangan` int(11) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_tugas_standar` int(11) NOT NULL,
  `prioritas` enum('tinggi','sedang','rendah') NOT NULL DEFAULT 'sedang',
  `status` enum('pending','proses','selesai') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pengerjaan`),
  
  -- Definisi Foreign Key
  CONSTRAINT `fk_pengerjaan_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pengerjaan_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pengerjaan_tugas` FOREIGN KEY (`id_tugas_standar`) REFERENCES `tugas_standar` (`id_tugas_standar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Insert sample data
INSERT INTO `pengerjaan` (`id_ruangan`, `id_user`, `id_tugas_standar`, `prioritas`, `status`) VALUES
(1, 1, 1, 'tinggi', 'pending'),
(1, 1, 2, 'sedang', 'pending'),
(2, 2, 3, 'tinggi', 'proses'),
(2, 2, 4, 'rendah', 'pending'),
(3, 1, 5, 'sedang', 'selesai');
