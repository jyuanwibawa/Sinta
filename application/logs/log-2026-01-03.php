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
DEBUG - 2026-01-03 16:51:53 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:51:53 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:51:53 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:51:53 --> SubmitTugas constructor called
DEBUG - 2026-01-03 16:51:53 --> SubmitTugas constructor - Session check: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:51:53 --> SubmitTugas constructor completed successfully
DEBUG - 2026-01-03 16:51:53 --> SubmitTugas index called with barcode: RM000001
DEBUG - 2026-01-03 16:51:53 --> User ID from session: 1
DEBUG - 2026-01-03 16:51:53 --> Pengerjaan found: stdClass Object
(
    [id_pengerjaan] => 13
    [id_ruangan] => 1
    [id_user] => 1
    [tugas] => ["dsdsdsd"]
    [standar] => ["dsdsdsd"]
    [foto_before] => ["test_before.jpg"]
    [foto_after] => ["test_after.jpg"]
    [catatan] => Test catatan
    [completed_at] => 2026-01-03 16:44:41
    [prioritas] => tinggi
    [status] => selesai
    [created_at] => 2026-01-03 20:21:24
    [updated_at] => 2026-01-03 22:44:41
    [nama_ruangan] => Ruang Meeting Utama
    [lantai] => 2
    [luas] => 50.50
    [nama_user] => DADI RACHMADI, S.H., M.H.
    [user_id] => 1
)

DEBUG - 2026-01-03 16:51:53 --> Validating barcode: RM000001
DEBUG - 2026-01-03 16:51:53 --> Barcode validation passed
DEBUG - 2026-01-03 16:51:53 --> Loading submit_tugas view
DEBUG - 2026-01-03 16:51:53 --> Total execution time: 0.0778
DEBUG - 2026-01-03 16:52:09 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:52:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:52:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor called
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor - Session check: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor completed successfully
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas index called with barcode: complete
DEBUG - 2026-01-03 16:52:09 --> User ID from session: 1
DEBUG - 2026-01-03 16:52:09 --> Pengerjaan found: stdClass Object
(
    [id_pengerjaan] => 13
    [id_ruangan] => 1
    [id_user] => 1
    [tugas] => ["dsdsdsd"]
    [standar] => ["dsdsdsd"]
    [foto_before] => ["test_before.jpg"]
    [foto_after] => ["test_after.jpg"]
    [catatan] => Test catatan
    [completed_at] => 2026-01-03 16:44:41
    [prioritas] => tinggi
    [status] => selesai
    [created_at] => 2026-01-03 20:21:24
    [updated_at] => 2026-01-03 22:44:41
    [nama_ruangan] => Ruang Meeting Utama
    [lantai] => 2
    [luas] => 50.50
    [nama_user] => DADI RACHMADI, S.H., M.H.
    [user_id] => 1
)

DEBUG - 2026-01-03 16:52:09 --> Validating barcode: complete
DEBUG - 2026-01-03 16:52:09 --> Invalid barcode provided
DEBUG - 2026-01-03 16:52:09 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:52:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:52:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:52:09 --> Total execution time: 0.0536
DEBUG - 2026-01-03 16:52:09 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:52:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:52:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor called
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor - Session check: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:52:09 --> SubmitTugas constructor completed successfully
DEBUG - 2026-01-03 16:52:09 --> SubmitTugas index called with barcode: complete
DEBUG - 2026-01-03 16:52:09 --> User ID from session: 1
DEBUG - 2026-01-03 16:52:09 --> Pengerjaan found: stdClass Object
(
    [id_pengerjaan] => 13
    [id_ruangan] => 1
    [id_user] => 1
    [tugas] => ["dsdsdsd"]
    [standar] => ["dsdsdsd"]
    [foto_before] => ["test_before.jpg"]
    [foto_after] => ["test_after.jpg"]
    [catatan] => Test catatan
    [completed_at] => 2026-01-03 16:44:41
    [prioritas] => tinggi
    [status] => selesai
    [created_at] => 2026-01-03 20:21:24
    [updated_at] => 2026-01-03 22:44:41
    [nama_ruangan] => Ruang Meeting Utama
    [lantai] => 2
    [luas] => 50.50
    [nama_user] => DADI RACHMADI, S.H., M.H.
    [user_id] => 1
)

DEBUG - 2026-01-03 16:52:09 --> Validating barcode: complete
DEBUG - 2026-01-03 16:52:09 --> Invalid barcode provided
DEBUG - 2026-01-03 16:52:09 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:52:09 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:52:09 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:52:09 --> Total execution time: 0.0894
DEBUG - 2026-01-03 16:53:08 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:53:08 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:53:08 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:53:08 --> SubmitTugas constructor called
DEBUG - 2026-01-03 16:53:08 --> SubmitTugas constructor - Session check: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:53:08 --> SubmitTugas constructor completed successfully
DEBUG - 2026-01-03 16:53:08 --> SubmitTugas::index method called with barcode: RM000001
DEBUG - 2026-01-03 16:53:08 --> User ID from session: 1
DEBUG - 2026-01-03 16:53:08 --> Pengerjaan found: stdClass Object
(
    [id_pengerjaan] => 13
    [id_ruangan] => 1
    [id_user] => 1
    [tugas] => ["dsdsdsd"]
    [standar] => ["dsdsdsd"]
    [foto_before] => ["test_before.jpg"]
    [foto_after] => ["test_after.jpg"]
    [catatan] => Test catatan
    [completed_at] => 2026-01-03 16:44:41
    [prioritas] => tinggi
    [status] => selesai
    [created_at] => 2026-01-03 20:21:24
    [updated_at] => 2026-01-03 22:44:41
    [nama_ruangan] => Ruang Meeting Utama
    [lantai] => 2
    [luas] => 50.50
    [nama_user] => DADI RACHMADI, S.H., M.H.
    [user_id] => 1
)

DEBUG - 2026-01-03 16:53:08 --> Validating barcode: RM000001
DEBUG - 2026-01-03 16:53:08 --> Barcode validation passed
DEBUG - 2026-01-03 16:53:08 --> Loading submit_tugas view
DEBUG - 2026-01-03 16:53:08 --> Total execution time: 0.0539
DEBUG - 2026-01-03 16:53:27 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:53:27 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:53:27 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:53:27 --> SubmitTugas constructor called
DEBUG - 2026-01-03 16:53:27 --> SubmitTugas constructor - Session check: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:53:27 --> SubmitTugas constructor completed successfully
DEBUG - 2026-01-03 16:53:27 --> SubmitTugas::complete method called directly
DEBUG - 2026-01-03 16:53:27 --> SubmitTugas::complete called
DEBUG - 2026-01-03 16:53:27 --> POST data: Array
(
    [task_count] => 1
    [notes] => apa aja

)

DEBUG - 2026-01-03 16:53:27 --> FILES data: Array
(
    [foto_before_0] => Array
        (
            [name] => 2.png
            [type] => image/png
            [tmp_name] => D:\xampp\tmp\phpBC85.tmp
            [error] => 0
            [size] => 31465
        )

    [foto_after_0] => Array
        (
            [name] => Screenshot_2.jpg
            [type] => image/jpeg
            [tmp_name] => D:\xampp\tmp\phpBC86.tmp
            [error] => 0
            [size] => 55510
        )

)

DEBUG - 2026-01-03 16:53:27 --> Session data: Array
(
    [__ci_last_regenerate] => 1767455513
    [user_logged_in] => 1
    [user_id] => 1
    [email] => dadi_rachmadi@mahkamahagung.go.id
    [nama] => DADI RACHMADI, S.H., M.H.
    [role] => 1
    [role_text] => User
    [satker_id] => 1
    [jabatan_id] => 1
    [login_time] => 2026-01-03 14:45:14
)

DEBUG - 2026-01-03 16:53:27 --> Session validation passed
DEBUG - 2026-01-03 16:53:27 --> User ID: 1
DEBUG - 2026-01-03 16:53:27 --> Pengerjaan found: 13
DEBUG - 2026-01-03 16:53:27 --> Task count: 1
DEBUG - 2026-01-03 16:53:27 --> Notes: apa aja

DEBUG - 2026-01-03 16:53:27 --> Processing task 0: foto_before_0, foto_after_0
DEBUG - 2026-01-03 16:53:27 --> Handling upload for field: foto_before_0
DEBUG - 2026-01-03 16:53:27 --> File info for foto_before_0: Array
(
    [name] => 2.png
    [type] => image/png
    [tmp_name] => D:\xampp\tmp\phpBC85.tmp
    [error] => 0
    [size] => 31465
)

DEBUG - 2026-01-03 16:53:27 --> MIME type for foto_before_0: image/png
DEBUG - 2026-01-03 16:53:27 --> Moving file from D:\xampp\tmp\phpBC85.tmp to ./uploads/pengerjaan/pengerjaan_before_13_task_0_1767455607.png
DEBUG - 2026-01-03 16:53:27 --> File moved successfully: ./uploads/pengerjaan/pengerjaan_before_13_task_0_1767455607.png
DEBUG - 2026-01-03 16:53:27 --> Handling upload for field: foto_after_0
DEBUG - 2026-01-03 16:53:27 --> File info for foto_after_0: Array
(
    [name] => Screenshot_2.jpg
    [type] => image/jpeg
    [tmp_name] => D:\xampp\tmp\phpBC86.tmp
    [error] => 0
    [size] => 55510
)

DEBUG - 2026-01-03 16:53:27 --> MIME type for foto_after_0: image/jpeg
DEBUG - 2026-01-03 16:53:27 --> Moving file from D:\xampp\tmp\phpBC86.tmp to ./uploads/pengerjaan/pengerjaan_after_13_task_0_1767455607.jpg
DEBUG - 2026-01-03 16:53:27 --> File moved successfully: ./uploads/pengerjaan/pengerjaan_after_13_task_0_1767455607.jpg
DEBUG - 2026-01-03 16:53:27 --> Upload results - Before: Success, After: Success
DEBUG - 2026-01-03 16:53:27 --> Update data: Array
(
    [status] => selesai
    [foto_before] => ["uploads\/pengerjaan\/pengerjaan_before_13_task_0_1767455607.png"]
    [foto_after] => ["uploads\/pengerjaan\/pengerjaan_after_13_task_0_1767455607.jpg"]
    [catatan] => apa aja

    [completed_at] => 2026-01-03 16:53:27
)

DEBUG - 2026-01-03 16:53:27 --> Update successful
DEBUG - 2026-01-03 16:53:27 --> Total execution time: 0.0916
DEBUG - 2026-01-03 16:53:29 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:53:29 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:53:29 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:53:29 --> Total execution time: 0.0799
DEBUG - 2026-01-03 16:53:38 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:53:38 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:53:38 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:53:38 --> Total execution time: 0.0668
DEBUG - 2026-01-03 16:53:44 --> UTF-8 Support Enabled
DEBUG - 2026-01-03 16:53:44 --> Global POST, GET and COOKIE data sanitized
DEBUG - 2026-01-03 16:53:44 --> Session: "sess_save_path" is empty; using "session.save_path" value from php.ini.
DEBUG - 2026-01-03 16:53:44 --> Total execution time: 0.0719
