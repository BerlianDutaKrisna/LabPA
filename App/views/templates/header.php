<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login_dulu"] = "Harap Login Terlebih Dahulu";
    header("Location: login.php");
    exit;
}
require 'functions.php';
function formatTanggal($date, $format) {
    if (is_null($date) || empty($date)) {
        return ''; // Anda dapat menyesuaikan teks placeholder ini
    }
    $english = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 
                     'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
                     'September', 'October', 'November', 'December');
    $indonesian = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 
                        'September', 'Oktober', 'November', 'Desember');
    return str_replace($english, $indonesian, date($format, strtotime($date)));
}
$data_proses = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'done'");

$data_samples_accepted = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'samples accepted'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_slicing = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'slicing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_grossing = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'grossing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_processing = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'processing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_embedding = query("SELECT *,DATE_FORMAT(wkt_mem, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mem, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_sem, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_sem, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'embedding'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_trimming = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'trimming'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_reading = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
INNER JOIN dokter ON hpa.id_dokter = dokter.id_dokter 
WHERE jenis_proses = 'reading'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_writing = query("SELECT * FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'writing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$jumlah_samples_accepted = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'samples accepted' AND status_proses != 'checked'");
$jumlah_slicing = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'slicing' AND status_proses != 'sliced'");
$jumlah_grossing = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'grossing' AND status_proses != 'grossed'");
$jumlah_processing = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'processing' AND status_proses != 'processed'");
$jumlah_embedding = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'embedding' AND status_proses != 'embedded'");
$jumlah_trimming = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'trimming' AND status_proses != 'trimmed'");
$jumlah_reading = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'reading' AND status_proses != 'already read'");
$jumlah_writing = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses = 'writing' AND status_proses != 'already writen'");
$jumlah_proses_hpa = query("SELECT COUNT(*) AS total_rows
FROM proses
WHERE jenis_proses != 'selesai'");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <meta http-equiv="refresh" content="5"> -->

    <title>Traker Histopatologi</title>
    <link href='img/favicon.ico' rel='shortcut icon'>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        .diterima {
            color: red;
            font-weight: bold;
        }
        .mulai {
            color: orange;
            font-weight: bold;
        }
        .selesai {
            color: green;
            font-weight: bold;
        }
        .default {
            color: black;
        }
    </style>
    <!-- Table styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">