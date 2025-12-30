<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-08-09 18:29:06 --> Severity: Notice --> Undefined variable: satker /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 18:29:06 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 18:29:09 --> Query error: Unknown column 'jl.id_jlayanan' in 'on clause' - Invalid query: SELECT * FROM konsultasi ks
                                    LEFT JOIN jenisperkara jp ON ks.id_jperkara=jp.id_jperkara
                                    LEFT JOIN subjenisperkara sjp ON ks.id_sjperkara=sjp.id_sjperkara
                                    LEFT JOIN jenislayanan jl ON ks.id_jlayanan=jl.id_jlayanan
                                    LEFT JOIN kategori kt ON ks.id_kategori=kt.id_kategori
                                    LEFT JOIN adref_satker_instansi asi1 ON asi1.satker_id=ks.satker_id_asal
                                    LEFT JOIN adref_satker_instansi asi2 ON asi2.satker_id=ks.satker_id_tujuan
                                    WHERE satker_id_tujuan='1' AND satker_id_asal='4'
                                    ORDER BY ks.id_konsultasi DESC
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 18:32:03 --> Severity: Notice --> Undefined variable: get_list_objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 18:32:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 18:32:47 --> Severity: Notice --> Undefined variable: get_list_objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 18:32:47 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: data /var/www/html/sinta/application/controllers/Pn.php 89
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vhead.php 8
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 26
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 39
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 50
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 65
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 78
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 91
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 104
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 117
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vsidebar.php 130
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: get_satker /var/www/html/sinta/application/views/layout/vsidebar.php 144
ERROR - 2024-08-09 18:34:38 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/layout/vsidebar.php 144
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: title /var/www/html/sinta/application/views/layout/vtitle.php 9
ERROR - 2024-08-09 18:34:38 --> Severity: Notice --> Undefined variable: page /var/www/html/sinta/application/views/index.php 8
ERROR - 2024-08-09 18:34:56 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:34:56 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:34:56 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:34:56 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:34:56 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 18:35:28 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:35:28 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:35:28 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:35:28 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:35:28 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$id_jeniskasus /var/www/html/sinta/application/views/pn/detil_data.php 376
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pn/detil_data.php 376
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined variable: get_list_jeniskasus /var/www/html/sinta/application/views/pn/detil_data.php 378
ERROR - 2024-08-09 18:36:25 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pn/detil_data.php 378
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$instansi /var/www/html/sinta/application/views/pn/detil_data.php 387
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pn/detil_data.php 393
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined variable: get_list_objek /var/www/html/sinta/application/views/pn/detil_data.php 410
ERROR - 2024-08-09 18:36:25 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pn/detil_data.php 410
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$kota /var/www/html/sinta/application/views/pn/detil_data.php 419
ERROR - 2024-08-09 18:36:25 --> Severity: Notice --> Undefined property: stdClass::$kelurahan /var/www/html/sinta/application/views/pn/detil_data.php 425
ERROR - 2024-08-09 18:36:29 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 18:36:29 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 18:36:29 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:36:29 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 18:36:29 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 22:56:48 --> Severity: Notice --> Undefined variable: satker /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 22:56:48 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 22:56:53 --> Severity: Notice --> Undefined variable: satker /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 22:56:53 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/view_login.php 64
ERROR - 2024-08-09 22:56:56 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:56:56 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:56:56 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 22:56:56 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 22:56:56 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 22:58:59 --> Severity: Notice --> Undefined variable: get_list_objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 22:58:59 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:00:23 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:00:57 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:00:57 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:00:57 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:00:57 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:00:57 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$id_kasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 59
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jumrespon /var/www/html/sinta/application/views/pos_bakum/regis_data.php 60
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$nosurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 72
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$tanggalsurat /var/www/html/sinta/application/views/pos_bakum/regis_data.php 74
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jeniskegiatan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 79
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$perihal /var/www/html/sinta/application/views/pos_bakum/regis_data.php 81
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 83
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:05:01 --> Severity: Notice --> Undefined variable: get_list_objek /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 23:05:01 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 238
ERROR - 2024-08-09 23:06:24 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:06:24 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:06:24 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:06:24 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:06:24 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:09:52 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:09:52 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:09:52 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:09:52 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:09:52 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:09:54 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:02 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:10:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:10:03 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:03 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:10:05 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:10:05 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:10:05 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:05 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:10:06 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:07 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:10:08 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:10:08 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:10:08 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:08 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:10:08 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:11:18 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:11:18 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:11:18 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:11:18 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:11:18 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:11:21 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:11:21 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:11:21 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:11:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:11:21 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:12:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:12:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:12:23 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:23 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:23 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:12:36 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:12:36 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:12:36 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:36 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:36 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:38 --> 404 Page Not Found: Pb/satker
ERROR - 2024-08-09 23:12:39 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:12:39 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:12:39 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:39 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:12:39 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:14:32 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:14:32 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:14:32 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:14:32 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:14:32 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:14:37 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:14:37 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:14:37 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:14:37 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:14:37 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:20:51 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:20:51 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:20:51 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:20:51 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:20:51 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:20:52 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:20:52 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:20:52 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:20:52 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:20:52 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:21:03 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:21:03 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:21:03 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:21:03 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:21:03 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:21:10 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:21:10 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:21:10 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:21:10 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:21:10 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:09 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:09 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:09 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:09 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:09 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:11 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:11 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:11 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:11 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:11 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:17 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:17 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:17 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:17 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:17 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:19 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:19 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:21 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:21 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:21 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:21 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:21 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:24 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:26 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:26 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:26:27 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:26:27 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:26:27 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:27 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:26:27 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:30:04 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:30:04 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:30:04 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:30:04 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:30:04 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:30:05 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:30:05 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:30:05 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:30:05 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 217
ERROR - 2024-08-09 23:30:05 --> Severity: Notice --> Undefined variable: get_list_jlayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 224
ERROR - 2024-08-09 23:32:17 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:32:17 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:32:17 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:32:17 --> Severity: Notice --> Undefined property: stdClass::$jenislayanan /var/www/html/sinta/application/views/pos_bakum/regis_data.php 218
ERROR - 2024-08-09 23:36:47 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:36:47 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:40:48 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:40:48 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:43:27 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:43:27 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:44:12 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:44:12 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:44:12 --> Severity: Notice --> Undefined variable: get_list_sjperkara /var/www/html/sinta/application/views/pos_bakum/regis_data.php 244
ERROR - 2024-08-09 23:44:12 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 244
ERROR - 2024-08-09 23:44:26 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:44:26 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:44:26 --> Severity: Notice --> Undefined variable: get_list_sjperkara /var/www/html/sinta/application/views/pos_bakum/regis_data.php 236
ERROR - 2024-08-09 23:44:26 --> Severity: Notice --> Undefined variable: get_list_sjperkara /var/www/html/sinta/application/views/pos_bakum/regis_data.php 244
ERROR - 2024-08-09 23:44:26 --> Severity: Warning --> Invalid argument supplied for foreach() /var/www/html/sinta/application/views/pos_bakum/regis_data.php 244
ERROR - 2024-08-09 23:45:34 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:45:34 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:45:34 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:45:34 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:46:16 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:46:16 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:46:16 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:46:16 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:51:29 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:51:29 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:51:29 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:51:29 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:51:38 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:51:38 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:51:38 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:51:38 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:52:10 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:52:10 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:52:10 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:52:10 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:52:18 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:52:18 --> Severity: Notice --> Undefined variable: id_jperkara /var/www/html/sinta/application/models/Model_pb.php 35
ERROR - 2024-08-09 23:52:18 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:52:18 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:52:53 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:52:53 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:52:53 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:53:24 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:53:24 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:53:24 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:57:07 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:57:07 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:57:07 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
ERROR - 2024-08-09 23:58:23 --> Severity: Warning --> Missing argument 1 for Model_pb::get_list_sjperkara(), called in /var/www/html/sinta/application/controllers/Pn.php on line 83 and defined /var/www/html/sinta/application/models/Model_pb.php 33
ERROR - 2024-08-09 23:58:23 --> Severity: Notice --> Undefined property: stdClass::$jeniskasus /var/www/html/sinta/application/views/pos_bakum/regis_data.php 71
ERROR - 2024-08-09 23:58:23 --> Severity: Notice --> Undefined property: stdClass::$pihak /var/www/html/sinta/application/views/pos_bakum/regis_data.php 86
