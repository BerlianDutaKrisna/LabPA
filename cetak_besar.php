<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login_dulu"] = "Harap Login Terlebih Dahulu";
    header("Location: login.php");
    exit;
}
require 'functions.php';

function formatTanggal($date, $format) {
    $english = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 
                     'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
                     'September', 'October', 'November', 'December');
    $indonesian = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 
                        'September', 'Oktober', 'November', 'Desember');
    return str_replace($english, $indonesian, date($format, strtotime($date)));
}

if (isset($_GET['id_proses']) && isset($_GET['id_hpa'])) {
    $id_proses = $_GET['id_proses'];
    $id_hpa = $_GET['id_hpa'];

    $DATA_HPA = query("SELECT 
            hpa.*, 
            hpa.tgl_hpa AS tgl_hpa, 
            hpa.tgl_hasil_hpa AS tgl_hasil_hpa, 
            pasien.*, 
            dokter.*, 
            pengirim.*
        FROM hpa 
        INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
        INNER JOIN dokter ON hpa.id_dokter = dokter.id_dokter
        INNER JOIN pengirim ON hpa.id_pengirim = pengirim.id_pengirim
        WHERE hpa.id_hpa = $id_hpa")[0];

    $DATA_PROSES = query("SELECT 
        proses.*, 
        analis.*, 
        proses.wkt_msa AS wkt_msa,
        proses.wkt_mgr AS wkt_mgr,
        proses.wkt_mpr AS wkt_mpr,
        proses.wkt_mem AS wkt_mem,
        proses.wkt_mtr AS wkt_mtr,
        proses.wkt_str AS wkt_str
    FROM proses 
    INNER JOIN analis ON proses.id_analis = analis.id_analis
    WHERE proses.id_proses = $id_proses")[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table F4 Size</title>
    <style>
        @page {
            size: 215mm 330mm; /* F4 size */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
         td {
            border: 1px solid #000;
            text-align: left;
            padding: 5px;
            box-sizing: border-box; /* Include padding and border in element’s total width and height */
            overflow: hidden; /* Hide overflowing content */
            white-space: nowrap; /* Prevent text from wrapping */
            text-overflow: ellipsis; /* Show ellipsis for overflowing text */
        }
        .judul{
            font-weight: bold;
        }
        .text {
            display: block; /* Ensure the width is maintained even if there's no content */
            width: 194mm; /* Approximately the width of the printable area considering the margin */
            min-height: 280px; /* Maintain height */
        }
        .gambar {
            padding: 50px;            
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td colspan="1" rowspan="2">Kode HPA : <?= $DATA_HPA["kode_hpa"]; ?></td>
                <td colspan="1">Tanggal Mengerjakan :</td>
                <td colspan="1">Tanggal Janji Hasil :</td>
                <td colspan="1" rowspan="2">APD :</td>
            </tr>
            <tr>
                <td colspan="1"><?= formatTanggal($DATA_PROSES["wkt_mgr"], 'l, d F Y'); ?></td>
                <td colspan="1"><?= formatTanggal($DATA_HPA["tgl_hasil_hpa"], 'l, d F Y'); ?></td>
            </tr>
            <tr class="judul">
                <td colspan="2" class="judul" >Makroskopis</td>
                <td colspan="2" >Analis PA : <?= $DATA_PROSES["nama_analis"]; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text"><?= $DATA_HPA["makroskopis_hpa"]; ?></td>
            </tr>
            <tr class="judul">
                <td colspan="2">Mikroskopis</td>
                <td colspan="2">Dokter PA : <?= $DATA_HPA["nama_dokter"]; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="text"><?= $DATA_HPA["mikroskopis_hpa"]; ?></td>
            </tr>
            <tr class="judul">
                <td colspan="2">Traking Spesimen</td>
                <td colspan="2">Kualitas Sediaan</td>
            </tr>
            <tr>
                <td colspan="2">1. Bahan Diterima : <?= formatTanggal($DATA_PROSES["wkt_msa"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">1. Volume cairan fiksasi sesuai?</td>
            </tr>
            <tr>
                <td colspan="2">2. Makroskopis : <?= formatTanggal($DATA_PROSES["wkt_mgr"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">2. Jaringan terfiksasi merata?</td>
            </tr>
            <tr>
                <td colspan="2">3. Prosessing : <?= formatTanggal($DATA_PROSES["wkt_mpr"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">3. Blok parafin tidak ada fragmentasi?</td>
            </tr>
            <tr>
                <td colspan="2">4. Embeding (HPA) : <?= formatTanggal($DATA_PROSES["wkt_mem"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">4. Sediaan tanpa lipatan?</td>
            </tr>
            <tr>
                <td colspan="2">5. Mikrotomi (HPA) : <?= formatTanggal($DATA_PROSES["wkt_mtr"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">5. sediaan tanpa goresan mata pisau?</td>
            </tr>
            <tr>
                <td colspan="2">6. Pewarnaan : <?= formatTanggal($DATA_PROSES["wkt_str"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">6. Kontras warna sediaan cukup jelas?</td>
            </tr>
            <tr>
                <td colspan="2">7. Entelan : <?= formatTanggal($DATA_PROSES["wkt_str"], 'H:i l, d F Y'); ?></td>
                <td colspan="2">7. Sediaan tanpa gelembung?</td>
            </tr>
            <tr>
                <td colspan="2">8. Selesai : <?= formatTanggal($DATA_HPA["tgl_hasil_hpa"], 'l, d F Y'); ?></td>
                <td colspan="2">8. Sediaan tanpa bercak/sidik jari?</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr class="judul">
                <td colspan="6">Gambar</td>
            </tr>
            <tr>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
            </tr>
            <tr>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
