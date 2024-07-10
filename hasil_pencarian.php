<?php
session_start();
if (!isset($_SESSION["login"])) {
    $_SESSION["login_dulu"] = "Harap Login Terlebih Dahulu";
    header("Location: login.php");
    exit;
}
require 'functions.php';
$data_pengirim = query("SELECT * FROM pengirim INNER JOIN dokter ON pengirim.id_dokter = dokter.id_dokter");
if (isset($_POST["btn_cari_norm"])) {
    
    $pasien = cari_norm($_POST["input_norm"]);   
}
if(isset($_POST["btn_tambah_hpa"])) {

    $tambahdata = tambah_hpa($_POST);
}

// if (isset($_SESSION['pesan']) && ($inputType['inputType']) == true) {
//     echo '<p>' . $_SESSION['pesan'] . '</p>';
//     $inputType = 'text';
// }  else {
//     echo '<p>' . $_SESSION['pesan'] . '</p>';
//     $inputType = 'hidden';
//     }


// $pasien = query_pasien("SELECT * FROM pasien");
// if (isset($_POST["btn_cari_norm"])) {
    
//     $pasien = cari_norm($_POST["cari_norm"]);
// }
// if( isset($_POST["submit"])) {
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
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
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-plus-square"></i>
                    <span>Pemeriksaan</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Jenis Pemeriksaan:</h6>
                        <a class="collapse-item active" href="tambah_pemeriksaan.php">Histopatologi</a>
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
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
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
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
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
                    <div>
                        <h1 class="h4 text-gray-900 mb-4">HISTOPATOLOGI</h1>
                    </div>
  
                        <div class="card shadow mb-4">
                        <div class="card-header py-4">
                                <h6 class="m-0 font-weight-bold text-primary">Hasil Pencarian</h6>
                            </div>
                            <div class="card-body">
                                <label class="mb-2">Nomer Rekamedis</label>
                                <form action="" method="post" >
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
                                <form action="" method="post">
                                <div class="row">
                                    <div class="form-group col-6">

                                        <input type="hidden" name="id_pasien" class="form-control form-control-user" autocomplete="off"
                                        value="<?= $pasien['id_pasien']; ?>">
                                        <input type="hidden" name="id_analis" class="form-control form-control-user" autocomplete="off"
                                        value="<?= $_SESSION['id_analis']; ?>">
                                        
                                        <div class="form-group col-12">
                                        <label class="mb-2">Nama</label>
                                            <input type="text" name="nama_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['nama_pasien']; ?>">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">No Rekamedis</label>
                                            <input type="text" name="norm_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['norm_pasien']; ?>">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Jenis Kelamin</label>
                                            <input type="text" name="jk_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['jk_pasien']; ?>">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Tanggal Lahir</label>
                                            <input type="text" name="tgl_lahir_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['tgl_lahir_pasien']; ?>">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Alamat</label>
                                            <input type="text" name="alamat_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['alamat_pasien']; ?>">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Status Pasien</label>
                                            <input type="text" name="status_pasien" class="form-control form-control-user" autocomplete="off"
                                            value="<?= $pasien['status_pasien']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <div class="form-group col-12">
                                        <label class="mb-2">Kode HPA</label>
                                            <input type="text" name="kode_hpa" class="form-control form-control-user" autocomplete="off" autofocus>
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Diagnosis</label>
                                            <input type="text" name="diagnosis_hpa" class="form-control form-control-user" autocomplete="off">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Tangal Blangko Sampel</label>
                                            <input type="date" name="tgl_hpa" class="form-control form-control-user" autocomplete="off">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Tanggal Janji Hasil</label>
                                            <input type="date" name="tgl_hasil_hpa" class="form-control form-control-user" autocomplete="off">
                                        </div>
                                        <div class="form-group col-12">
                                        <label class="mb-2">Pengirim</label>
                                            <select name="id_pengirim" class="form-control form-control-user" autocomplete="off">
                                            <option selected value="">Pilih Asal Pengirim</option>
                                                <?php foreach ($data_pengirim as $row) : ?>
                                                <option value="<?= $row['id_pengirim']; ?>"><?= $row['nama_dokter']; ?> - <?= $row['ruangan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <a href="tambah_pemeriksaan.php" class="btn btn-warning btn-user btn-block">
                                            <i class="fas fa-reply"></i> Kembali
                                            </a>
                                        </div>
                                        <div class="form-group col-6">
                                            <button type="submit" name="btn_tambah_hpa" class="btn btn-success btn-user btn-block">
                                            <i class="fas fa-save"></i></i> Simpan
                                            </button>
                                        </div>                    
                                    </div>
                                    </div>                                      
                                </div>
                                
                                </form>
                            </div>
                        </div>
                              
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="m-3">
                                        <a href="samples_accepted.php" class="btn btn-red btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-clipboard"></i>
                                        </span>
                                        <span class="text">Samples Accepted</span>
                                        </a>                                    
                                    </div>
                                    <div class="m-3">
                                        <a href="slicing.php" class="btn btn-orange btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-puzzle-piece"></i>
                                        </span>
                                        <span class="text">Slicing</span>
                                        </a>
                                    </div>
                                    <div class="m-3">
                                        <a href="grossing.php" class="btn btn-yellow btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-cut"></i>
                                        </span>
                                        <span class="text">Grossing</span>
                                        </a>
                                    </div>                                    
                                    <div class="m-3">
                                        <a href="processing.php" class="btn btn-green btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-sync"></i>
                                        </span>
                                        <span class="text">Processing</span>
                                        </a>                                    
                                    </div>
                                    <div class="m-3">
                                        <a href="embedding.php" class="btn btn-light-blue btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-download"></i>
                                        </span>
                                        <span class="text">Embedding</span>
                                        </a>                                    
                                    </div>
                                    <div class="m-3">
                                        <a href="reading.php" class="btn btn-blue btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-microscope"></i>
                                        </span>
                                        <span class="text">Reading</span>
                                        </a>                                    
                                    </div>
                                    <div class="m-3">
                                        <a href="writing.php" class="btn btn-purple btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-keyboard"></i>
                                        </span>
                                        <span class="text">Writing</span>
                                        </a>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Berlian Web Developer &copy; SIM Lab PA 2024</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script src="js/bootstrap.js"></script>

</body>

</html>