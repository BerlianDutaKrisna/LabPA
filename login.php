<?php
session_start();
if (isset($_SESSION['login_dulu'])) {
    echo "<script>
            alert('$_SESSION[login_dulu]');
        </script>";
}
if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT user.*, analis.*
    FROM user
    INNER JOIN analis ON user.id_analis = analis.id_analis
    WHERE user.username = '$username'");
    
    if ( mysqli_num_rows($result) === 1) {
        //Cek Password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])){
            //Set Session
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION["id_analis"] = $row["id_analis"];
            $_SESSION["nama_analis"] = $row["nama_analis"];
            $_SESSION["foto_analis"] = $row["foto_analis"];
            $_SESSION["id_dokter"] = $row["id_dokter"];            
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-gray-900 mb-4">Sistem Informasi Laboratorium Patologi Anatomi ( SIM LAB PA )</p>
                                    </div>
                                    <?php if (isset($error)) : ?>
                                    <p style="color: red; font-style: italic;">Username / Password Salah</p>
                                    <?php endif; ?>
                                    <form action="" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username..." autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                </div>
                            </div>
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