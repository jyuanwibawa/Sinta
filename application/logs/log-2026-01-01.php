<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2026-01-01 02:14:25 --> 404 Page Not Found: Simetri/index
ERROR - 2026-01-01 02:15:24 --> 404 Page Not Found: Simetri/index
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/ruangan
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:18:05 --> 404 Page Not Found: Admin/assets
ERROR - 2026-01-01 02:39:10 --> Query error: Unknown column 'RU5OVWphbzIwUEczSG02VHZNZUxTZz09' in 'where clause' - Invalid query: SELECT asi.*,asi.nama_satker,
                    (SELECT COUNT(*) FROM kasus_pn kp WHERE kp.satker_id_tujuan=asi.satker_id AND kp.satker_id_asal=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_keluar,
                    (SELECT COUNT(DISTINCT(pd.id_kasus)) 
                        FROM permintaan_data pd 
                            LEFT JOIN kasus_pn kp ON kp.id_kasus=pd.id_kasus
                        WHERE kp.satker_id_tujuan=asi.satker_id AND kp.satker_id_asal=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_keluar_responded,
                    (SELECT COUNT(*) FROM kasus_pn kp WHERE kp.satker_id_asal=asi.satker_id AND kp.satker_id_tujuan=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_masuk,
                    (SELECT COUNT(DISTINCT(pd.id_kasus)) 
                        FROM permintaan_data pd 
                        LEFT JOIN kasus_pn kp ON kp.id_kasus=pd.id_kasus
                        WHERE kp.satker_id_asal=asi.satker_id AND kp.satker_id_tujuan=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_masuk_responded,
                    (SELECT COUNT(*) FROM konsultasi ks WHERE ks.satker_id_tujuan=asi.satker_id AND ks.satker_id_asal=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_keluar_pb,
                    (SELECT COUNT(DISTINCT(pdb.id_konsultasi)) 
                        FROM permintaan_data_pb pdb
                            LEFT JOIN konsultasi ks ON ks.id_konsultasi=pdb.id_konsultasi
                        WHERE ks.satker_id_tujuan=asi.satker_id AND ks.satker_id_asal=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_keluar_responded_pb,
                    (SELECT COUNT(*) FROM konsultasi ks WHERE ks.satker_id_asal=asi.satker_id AND ks.satker_id_tujuan=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_masuk_pb,
                    (SELECT COUNT(DISTINCT(pdb.id_konsultasi)) 
                        FROM permintaan_data_pb pdb
                        LEFT JOIN konsultasi ks ON ks.id_konsultasi=pdb.id_konsultasi
                        WHERE ks.satker_id_asal=asi.satker_id AND ks.satker_id_tujuan=RU5OVWphbzIwUEczSG02VHZNZUxTZz09) AS jum_masuk_responded_pb
                FROM adref_satker_instansi asi;
ERROR - 2026-01-01 02:44:46 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Model_simetri.php exists, but doesn't declare class Model_simetri D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-01 02:44:49 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Model_simetri.php exists, but doesn't declare class Model_simetri D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-01 02:45:05 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Model_simetri.php exists, but doesn't declare class Model_simetri D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-01 02:48:53 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Model_simetri.php exists, but doesn't declare class Model_simetri D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-01 02:49:07 --> Severity: error --> Exception: D:\xampp\htdocs\Sinta\application\models/Model_simetri.php exists, but doesn't declare class Model_simetri D:\xampp\htdocs\Sinta\system\core\Loader.php 341
ERROR - 2026-01-01 02:57:48 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 22 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:58:10 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 22 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:58:20 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 22 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:17 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:19 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:20 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:20 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:24 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 02:59:49 --> Severity: error --> Exception: Too few arguments to function Model_user::get(), 0 passed in D:\xampp\htdocs\Sinta\application\controllers\Simetri.php on line 26 and exactly 1 expected D:\xampp\htdocs\Sinta\application\models\Model_user.php 41
ERROR - 2026-01-01 03:01:08 --> Query error: Unknown column 'u_id' in 'field list' - Invalid query: SELECT nama, s.`seksi`, b.`jkajian` as bagian, aktivasi, email, u_id FROM user AS u
        JOIN `seksi` AS s ON
        u.`seksi` = s.`id_seksi`
        JOIN jeniskajian AS b ON
        u.`bagian` = b.`id_jkajian`
        ORDER BY u_id ASC
ERROR - 2026-01-01 03:01:55 --> Query error: Unknown column 'u.u_id' in 'field list' - Invalid query: SELECT u.nama, u.aktivasi, u.email, u.u_id, s.seksi, b.jkajian as bagian, u.role_text as role
        FROM user AS u
        LEFT JOIN `seksi` AS s ON u.`seksi` = s.`id_seksi`
        LEFT JOIN jeniskajian AS b ON u.`bagian` = b.`id_jkajian`
        ORDER BY u.u_id ASC
ERROR - 2026-01-01 03:02:24 --> Query error: Unknown column 'u.u_id' in 'field list' - Invalid query: SELECT u.nama, u.aktivasi, u.email, u.u_id, s.seksi, b.jkajian as bagian, u.role_text as role
        FROM user AS u
        LEFT JOIN `seksi` AS s ON u.`seksi` = s.`id_seksi`
        LEFT JOIN jeniskajian AS b ON u.`bagian` = b.`id_jkajian`
        ORDER BY u.u_id ASC
ERROR - 2026-01-01 03:02:47 --> Query error: Unknown column 'u.u_id' in 'field list' - Invalid query: SELECT u.nama, u.aktivasi, u.email, u.u_id, u.role_text as role
        FROM user AS u
        ORDER BY u.u_id ASC
ERROR - 2026-01-01 03:02:57 --> Query error: Unknown column 'u.u_id' in 'field list' - Invalid query: SELECT u.nama, u.aktivasi, u.email, u.u_id, u.role_text as role
        FROM user AS u
        ORDER BY u.u_id ASC
ERROR - 2026-01-01 03:03:49 --> Query error: Unknown column 'u_id' in 'order clause' - Invalid query: SELECT * FROM user ORDER BY u_id ASC
ERROR - 2026-01-01 03:04:01 --> Query error: Unknown column 'u_id' in 'order clause' - Invalid query: SELECT * FROM user ORDER BY u_id ASC
ERROR - 2026-01-01 03:19:05 --> 404 Page Not Found: Register/index
ERROR - 2026-01-01 03:31:23 --> Query error: Unknown column 'u_id' in 'where clause' - Invalid query: UPDATE user SET waktu_daftar=now() WHERE u_id = '1'
ERROR - 2026-01-01 03:35:21 --> 404 Page Not Found: Loginuuser/index
