<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
    require "functions.php";
    $data_analis = query("SELECT * FROM analis");
    $data_dokter = query("SELECT * FROM dokter");
    if( isset($_POST["btn_register"])) {
        if( register($_POST) > 0 ) {
            echo "
                <script>
                    alert('user baru ditambahkan');
                </script>";
                header("Location: login.php");
        } else {
            var_dump(mysqli_error($conn)); die;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Traker Histopatologi</title>
    <link href='img/favicon.ico' rel='shortcut icon'>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-custom">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrasi User</h1>
                            </div>
                            <form action="" method="post" class="user">
                            <div class="form-group col-12">
                            <input type="text" name="username" class="form-control form-control-user"
                            placeholder="username" autocomplete="off" autofocus>
                            </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            placeholder="password" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password2" class="form-control form-control-user"
                                            placeholder="Repeat Password" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                <select name="id_analis" class="form-control" autocomplete="off">
                                <option selected value=NULL >User untuk analis..</option>
                                    <?php foreach ($data_analis as $row) : ?>
                                    <option value="<?= $row['id_analis']; ?>"><?= $row['nama_analis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div class="form-group col-12">
                                <select name="id_dokter" class="form-control" autocomplete="off">
                                <option selected value=NULL >User untuk dokter..</option>
                                    <?php foreach ($data_dokter as $row) : ?>
                                    <option value="<?= $row['id_dokter']; ?>"><?= $row['nama_dokter']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div class="form-group col-12">
                                <label>
                                <input type="radio" name="status_user" value="admin"> Admin
                                </label><br>
                                <label>
                                <input type="radio" name="status_user" value="pengunjung"> Pengunjung
                                </label><br>
                                </div>
                                <button name="btn_register" type="submit" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            </form>
                        </div>
                    </div>
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

</body>

</html>