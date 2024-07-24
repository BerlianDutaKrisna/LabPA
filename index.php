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
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-binoculars"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Traker Histopatologi</div>
                    <!-- <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a> -->
                            <!-- Dropdown - Messages -->
                            <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> -->
                        
                        <!-- Nav Item - Alerts -->
                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i> -->
                                <!-- Counter - Alerts -->
                                <!-- <span class="badge badge-danger badge-counter">3+</span>
                            </a> -->
                            <!-- Dropdown - Alerts -->
                            <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li> -->

                        <!-- Nav Item - Messages -->
                        <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i> -->
                                <!-- Counter - Messages -->
                                <!-- <span class="badge badge-danger badge-counter">7</span>
                            </a> -->
                            <!-- Dropdown - Messages -->
                            <!-- <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the processs so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li> -->

                        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama_analis']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/<?= $_SESSION['foto_analis']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Traker of Histologi Process</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div> -->
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Jumlah sampel yang belum selesai</h1>
                    <p class="mb-3 text-danger">A goal is a dream with a deadline - Napoleon Hill</p>
                    <!-- Content Row -->
                    <div class="row">

<!-- Histopatologi RESUME -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        HISTOPATOLOGI ( HPA )</div>
                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $jumlah_proses_hpa[0]['total_rows']?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-drumstick-bite fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SITOLOGI RESUME -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        SITOLOGI ( SRS )</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-prescription-bottle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FINE NEEDLE ASPIRATION BIOPSY RESUME -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Fine Needle Aspiration Biopsy ( FNAB )
                    </div>
                    <div class="row no-gutters align-items-center">
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-syringe fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- IMUNOHISTOKIMIA RESUME -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Imunohistokimia</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-vials fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-4">
    <h6 class="m-0 font-weight-bold text-primary">Tambah Pemeriksaan</h6>
    </div>
    <div class="card-body">                        
    <label class="mb-2">Nomer Rekamedis</label>
        <form action="hasil_pencarian.php" method="post" >
            <div class="input-group col-5 mb-5">
                <input type="text" name="input_norm" class="form-control bg-light border-0 small" autocomplete="off" placeholder="Pecarian nomer rekamedis pasien">
                <div class="input-group-append">
                    <button class="btn btn-primary" name="btn_cari_norm" type="submit">
                    <i class="fas fa-search fa-sm"></i> Cari </button>
                    <a href="tambah_pasien.php" class="btn btn-success">
                    <i class="fas fa-plus"></i></i> Tambah Data Pasien </a>
                </div>
            </div>
        </form>
    </div>                 
    </div>      
    <div class="card-header py-3">
    <div class="row">
        <div class="m-3"> 
            <a href="samples_accepted.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_samples_accepted[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_samples_accepted[0]['total_rows']?>
                </span>
                <span class="text">Samples Accepted</span>
            </a>  
        </div>
        <div class="m-3">
            <a href="slicing.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_slicing[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_slicing[0]['total_rows']?>
                </span>
                <span class="text">Slicing</span>
            </a>
        </div>
        <div class="m-3">
            <a href="grossing.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_grossing[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_grossing[0]['total_rows']?>
                </span>
                <span class="text">Grossing</span>
            </a>
        </div>                                    
        <div class="m-3">
            <a href="processing.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_processing[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_processing[0]['total_rows']?>
                </span>
                <span class="text">Processing</span>
            </a>                                    
        </div>
        <div class="m-3">
            <a href="embedding.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_embedding[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_embedding[0]['total_rows']?>
                </span>
                <span class="text">Embedding</span>
            </a>                                    
        </div>
        <div class="m-3">
            <a href="trimming.php" class="btn btn-primary btn-icon-split btn-lg">
                <span class="icon <?= ($jumlah_trimming[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
                <?= $jumlah_trimming[0]['total_rows']?>
                </span>
                <span class="text">Trimming / Staining</span>
            </a>                                    
        </div>
        <div class="m-3">
            <a href="reading.php" class="btn btn-primary btn-icon-split btn-lg">
            <span class="icon <?= ($jumlah_reading[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
            <?= $jumlah_reading[0]['total_rows']?>
            </span>
            <span class="text">Reading</span>
            </a>                                    
        </div>
        <div class="m-3">
            <a href="writing.php" class="btn btn-primary btn-icon-split btn-lg">
            <span class="icon <?= ($jumlah_writing[0]['total_rows']>0)? 'text-red' : 'text-white';?>">
            <?= $jumlah_writing[0]['total_rows']?>
            </span>
            <span class="text">Writing</span>
            </a>                                    
        </div>
        <div class="m-3">
            <a href="verification.php" class="btn btn-primary btn-icon-split btn-lg">
            <span class="icon ">
            </span>
            <span class="text">Verifikasi</span>
            </a>                                    
        </div>
    </div>
</div>
<div id="table_live_process">
    <!-- Table Traker of Histologi Process -->
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Traker of Histologi Process HISTOPATOLOGI</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    
                        <div class="form-group col-12">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="samples_accepted.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-clipboard"></i>
                                            </span>
                                            <span class="text">Samples Accepted</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_samples_accepted as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "not checked") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "checking") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "checked") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_msa"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_msa"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_ssa"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_ssa"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="slicing.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-puzzle-piece"></i>
                                            </span>
                                            <span class="text">Slicing</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_slicing as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "not sliced") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "slicing") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "sliced") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_msl"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_msl"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_ssl"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_ssl"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="grossing.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-cut"></i>
                                            </span>
                                            <span class="text">Grossing</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_grossing as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "ungrossed") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "grossing") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "grossed") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mgr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mgr"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_sgr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_sgr"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="processing.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-sync"></i>
                                            </span>
                                            <span class="text">Processing</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_processing as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "unprocessed") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "processing") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "processed") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mpr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mpr"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_spr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_spr"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="embedding.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-download"></i>
                                            </span>
                                            <span class="text">Embedding</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_embedding as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "unembedded") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "embedding") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "embedded") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mem"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mrd"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_sem"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_sem"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="trimming.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-grip-horizontal"></i>
                                            </span>
                                            <span class="text">Trimming / Staining</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_trimming as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "not trimmed") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "trimming") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "trimmed") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mtr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mtr"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_str"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_str"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="reading.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-microscope"></i>
                                            </span>
                                            <span class="text">Reading</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Dokter</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_reading as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "unread") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "reading") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "already read") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mrd"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mrd"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_srd"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_srd"], 'H:i'); ?></td>
                                        <td><?= $row['nama_dokter']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group col-12">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th colspan="6"><a href="writing.php" class="btn btn-primary btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-keyboard"></i>
                                            </span>
                                            <span class="text">Writing</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Nomer Rekamedis</th>
                                        <th>Nama Pasien</th>
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
                                    </tr>
                                    <?php $i = 1; ?>                                            
                                    <?php foreach ($data_writing as $row) : ?>
                                        <?php $status_proses = $row["status_proses"];
                                            $class = "default"; // Default class
                                            if ($status_proses == "not written") {
                                                $class = "diterima";
                                            } elseif ($status_proses == "writing") {
                                                $class = "mulai";
                                            } elseif ($status_proses == "already written") {
                                                $class = "selesai";
                                            } ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $row['kode_hpa']; ?></td>
                                        <td><?= $row['norm_pasien']; ?></td>
                                        <td><?= $row['nama_pasien']; ?></td>
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td><?=formatTanggal($row["wkt_mwr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_mwr"], 'H:i'); ?></td>
                                        <td><?=formatTanggal($row["wkt_swr"], 'l, d F Y'); ?> - <?=formatTanggal($row["wkt_swr"], 'H:i'); ?></td>
                                        <td><?= $row['nama_analis']; ?></td>
                                        <?php $i++; ?>
                                    </tr>  
                                    <?php endforeach; ?>                        
                                </tbody>
                            </table>
                        </div>                     
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content 1 -->
<!-- Content Row -->
<div class="row">
<!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah keseluruhan Sample HPA</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jumlah keseluruhan jenis pemeriksaan</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> HPA
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> FNAB
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Sitologi
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
<div id="content">
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Keseluruhan Pemeriksaan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Kode HPA</th>
                    <th>Nama Pasien</th>
                    <th>No RM Pasien</th>
                    <th>Diagnosa</th>
                    <th>Hasil HPA</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
            <?php foreach($data_proses as $row) : ?>
            <tbody>
                <tr>
                    <td><?= $row["kode_hpa"]; ?></td>
                    <td><?= $row["nama_pasien"]; ?></td>
                    <td><?= $row["norm_pasien"]; ?></td>
                    <td><?= $row["diagnosis_hpa"]; ?></td>
                    <td><?= $row["hasil_hpa"]; ?></td>
                    <td>
                    <a href="edit_hpa.php?id_proses=<?= $row['id_proses']; ?>&id_hpa=<?= $row['id_hpa']; ?>&from=index" class="btn btn-warning" >Edit</a>
                    <a href="delete.php?id=<?= $row["id_proses"]; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin menghapusnya')" >Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        </div>
    </div>
</div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingin Lougout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin pekerjaan anda sudah selesai?.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Table Search plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Table scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>