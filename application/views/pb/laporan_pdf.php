<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pos Layanan Hukum</title>
    <style>
        body {
            font-family: "Times New Rowman", Times,;
            font-size: 10px;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-border {
            border: none;
        }
        @page{
            margin: 10px;
        }
        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px; /* Adjust the width as needed */
        }
    </style>
</head>
<body>
    <img src='resources/user/logopn_user.png' alt="" class="logo">
    <h1>FORMULIR POS LAYANAN HUKUM PADA PENGADILAN NEGERI SURABAYA</h1>
    <h2>Lembaga : <?= $nama_lembaga; ?></h2>
    <h2>Periode <?= indonesian_date_only_without_days($dari_tanggal); ?> - <?= indonesian_date_only_without_days($hingga_tanggal); ?></h2>

    <br>
    <table>
        <tr>
            <th rowspan="2">NO.</th>
            <th rowspan="2">TGL.</th>
            <th colspan="4">IDENTITAS PEMOHON YANG MENDAPAT LAYANAN</th>
            <th colspan="2">LAYANAN</th>
            <th colspan="1">ADVOKAT PIKET</th>
            <th rowspan="2">KET.</th>
        </tr>
        <tr>
            <th>NAMA</th>
            <th>JENIS KELAMIN</th>
            <th>USIA</th>
            <th>PEKERJAAN</th>
            <th>JENIS LAYANAN</th>
            <th>TANGGAL/JAM <br>LAYANAN (DURASI)</th>
            <th>NAMA</th>
        </tr>
        <?php $no = 1; foreach ($data_konsultasi as $row): 
            if ($row->kategori == "Masyarakat Biasa"){
                $kategori = "MB";
            } else{
                $kategori = "MKM";
            }
        ?>
        <tr>
            <td class="text-center"><?= $no++; ?></td>
            <td class="text-center"><?= indonesian_date_only($row->tanggalkonsul); ?></td>
            <td><?= $row->nama; ?></td>
            <td class="text-center"><?= $row->jkelamin; ?></td>
            <td class="text-center"><?= $row->usia; ?> Tahun </td>
            <td><?= $row->pekerjaan; ?></td>
            <td><?= $row->klasifikasi; ?></td>
            <td class="text-center"><?= formatTime($row->durasi_layanan); ?></td>
            <td><?= $row->nama_advokat; ?></td>
            <td><?= $kategori ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <p>Demikian laporan Pos Layanan Hukum Pengadilan Negeri Surabaya atas perhatiannya kami haturkan terimakasih.</p>
    <p>Jumlah Keseluruhan Laporan Periode <?= indonesian_date_only_without_days($dari_tanggal); ?> - <?= indonesian_date_only_without_days($hingga_tanggal); ?></p>
    <p>Laki-laki : <?= $data_jk_gol->jumlah_pengunjung_laki; ?></p>
    <p>Perempuan : <?= $data_jk_gol->jumlah_pengunjung_perempuan; ?></p>
    <p>Masyarakat Biasa(MB) : <?= $data_jk_gol->jumlah_masyarakat_biasa; ?></p>
    <p>Masyarakat Kurang Mampu(MKM) : <?= $data_jk_gol->jumlah_masyarakat_kurang_mampu; ?></p>
</body>
</html>