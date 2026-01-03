<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-01-03 03:02:52 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Pengerjaan_model.php exists, but doesn't declare class Pengerjaan_model D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-03 03:03:02 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Pengerjaan_model.php exists, but doesn't declare class Pengerjaan_model D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-03 04:38:40 --> Pengerjaan index error: D:\xampp\htdocs\Sinta\application\models/Pengerjaan_model.php exists, but doesn't declare class Pengerjaan_model
ERROR - 2026-01-03 04:53:17 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Pengerjaan_model.php exists, but doesn't declare class Pengerjaan_model D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-03 04:55:32 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 04:55:56 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 04:57:46 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 04:59:40 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:01:49 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:02:21 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:02:36 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:06:25 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:11:22 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:12:30 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 05:17:14 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:18:37 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:20:31 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:20:50 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:20:56 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:21:29 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:22:34 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:25:48 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:26:32 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:30:39 --> Query error: Unknown column 'nip' in 'field list' - Invalid query: SELECT `user_id`, `nama`, `nip`
FROM `user`
WHERE `aktivasi` = 1
ORDER BY `nama`
ERROR - 2026-01-03 11:31:54 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:36:01 --> 404 Page Not Found: Assets/css
ERROR - 2026-01-03 11:46:36 --> Query error: Column 'id_tugas_standar' cannot be null - Invalid query: INSERT INTO `pengerjaan` (`id_ruangan`, `id_user`, `id_tugas_standar`, `prioritas`, `status`) VALUES ('4', '11', NULL, 'tinggi', 'pending')
ERROR - 2026-01-03 11:49:26 --> Query error: Column 'id_ruangan' cannot be null - Invalid query: INSERT INTO `pengerjaan` (`id_ruangan`, `id_user`, `id_tugas_standar`, `prioritas`, `status`) VALUES (NULL, NULL, 0, NULL, 'pending')
ERROR - 2026-01-03 11:49:36 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`sinta`.`pengerjaan`, CONSTRAINT `fk_pengerjaan_tugas` FOREIGN KEY (`id_tugas_standar`) REFERENCES `tugas_standar` (`id_tugas_standar`) ON DELETE CASCADE ON UPDATE CASCADE) - Invalid query: INSERT INTO `pengerjaan` (`id_ruangan`, `id_user`, `id_tugas_standar`, `prioritas`, `status`) VALUES ('4', '11', 0, 'tinggi', 'pending')
ERROR - 2026-01-03 12:06:05 --> Query error: Unknown column 'user_id' in 'field list' - Invalid query: INSERT INTO `tugas_standar` (`tugas`, `standar`, `user_id`) VALUES ('sss', 'sdsdsds', '0')
ERROR - 2026-01-03 12:07:21 --> Query error: Column 'tugas' cannot be null - Invalid query: INSERT INTO `tugas_standar` (`tugas`, `standar`) VALUES (NULL, NULL)
ERROR - 2026-01-03 12:13:34 --> Query error: Unknown column 'user_id' in 'field list' - Invalid query: INSERT INTO `tugas_standar` (`tugas`, `standar`, `user_id`) VALUES ('sadsdccccc', 'ccsccsc', '0')
ERROR - 2026-01-03 12:15:40 --> Query error: Column 'tugas' cannot be null - Invalid query: INSERT INTO `tugas_standar` (`tugas`, `standar`, `user_id`) VALUES (NULL, NULL, '0')
