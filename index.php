<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login_dulu"] = "Harap Login Terlebih Dahulu";
    header("Location: login.php");
    exit;
}
require 'functions.php';
$data_proses = query("SELECT *, DATE_FORMAT(tgl_hasil_hpa, '%d-%m-%Y') AS format_tgl_hasil_hpa, DATE_FORMAT(tgl_mengerjakan, '%d-%m-%Y') AS formatted_date, 
               DATE_FORMAT(tgl_mengerjakan, '%H:%i') AS formatted_time  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'done'");

$data_samples_accepted = query("SELECT *,DATE_FORMAT(wkt_msa, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_msa, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_ssa, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_ssa, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'samples accepted'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_slicing = query("SELECT *,DATE_FORMAT(wkt_msl, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_msl, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_ssl, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_ssl, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'slicing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_grossing = query("SELECT *,DATE_FORMAT(wkt_mgr, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mgr, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_sgr, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_sgr, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'grossing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_processing = query("SELECT *,DATE_FORMAT(wkt_mpr, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mpr, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_spr, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_spr, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
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

$data_trimming = query("SELECT *,DATE_FORMAT(wkt_mtr, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mtr, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_str, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_str, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'trimming'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_reading = query("SELECT *,DATE_FORMAT(wkt_mrd, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mrd, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_srd, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_srd, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'reading'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

$data_writing = query("SELECT *,DATE_FORMAT(wkt_mwr, '%d-%m-%Y') AS format_tgl_mengerjakan, 
               DATE_FORMAT(wkt_mwr, '%H:%i') AS format_waktu_mengerjakan, DATE_FORMAT(wkt_swr, '%d-%m-%Y') AS format_tgl_selesai_mengerjakan, 
               DATE_FORMAT(wkt_swr, '%H:%i') AS format_waktu_selesai_mengerjakan  FROM proses 
proses
INNER JOIN hpa ON proses.id_hpa = hpa.id_hpa
INNER JOIN pasien ON hpa.id_pasien = pasien.id_pasien
INNER JOIN analis ON proses.id_analis = analis.id_analis 
WHERE jenis_proses = 'writing'
ORDER BY ABS(TIMESTAMPDIFF(SECOND, tgl_hasil_hpa, NOW()))");

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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-binoculars"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Traker Histopatologi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-plus-square"></i>
                    <span>Pemeriksaan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis Pemeriksaan:</h6>
                        <a class="collapse-item" href="tambah_pemeriksaan.php">Histopatologi</a>
                        <a class="collapse-item" href="cards.html">Sitologi</a>
                        <a class="collapse-item" href="buttons.html">FNAB</a>
                        <a class="collapse-item" href="cards.html">Imunohistokimia</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Settings:</h6>
                        <a class="collapse-item" href="#">Pasien</a>
                        <a class="collapse-item" href="#">Analis</a>
                        <a class="collapse-item" href="#">Dokter</a>
                        <a class="collapse-item" href="#">Pengirim</a>
                        <a class="collapse-item" href="register.php">User</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <!-- <hr class="sidebar-divider d-none d-md-block"> -->

            <!-- Sidebar Toggler (Sidebar) -->
            <!-- <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div> -->

            <!-- Sidebar Message -->
            <!-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

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
                    <h1 class="h6 mb-0 text-gray-800">Traker of Histologi Process</h1>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/berlian.jpg">
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
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-vials fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                            <span class="text">Trimming</span></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <th>Status Proses</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Analis</th>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                        <td  class='<?= $class; ?>'><?= $row['status_proses']; ?></td>                                      
                                        <td>tanggal:  <?=$row['format_tgl_mengerjakan']; ?> pukul:  <?= $row['format_waktu_mengerjakan'] ?></td>
                                        <td>tanggal:  <?=$row['format_tgl_selesai_mengerjakan']; ?> pukul:  <?= $row['format_waktu_selesai_mengerjakan'] ?></td>
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
                                            <a href="edit.php?id=<?= $row["id_proses"]; ?>" class="btn btn-warning" >Edit</a>
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