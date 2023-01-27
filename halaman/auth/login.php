<?php
session_start();
$_SESSION['error'] = [];
require_once('../../db/koneksi.php');
if (isset($_POST['submit'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $q = "
        SELECT 
            pengguna.*,
            petugas.nik,
            petugas.nama,
            petugas.jabatan
        FROM 
            pengguna 
        LEFT JOIN 
            petugas 
        ON 
            pengguna.id=petugas.id_pengguna 
        WHERE 
            pengguna.username='$username' 
            AND 
            pengguna.password='$password' 
    ";
    $data = $mysqli->query($q);
    if ($data->num_rows) {
        $_SESSION['user'] =  $data->fetch_assoc();
        echo "<script>location.href = '../../index.php';</script>";
    } else
        $_SESSION['error'][] = "Username atau Password Salah!";
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

    <title>Halaman Login</title>
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <img src="../../assets/img/logo1.png" class="mb-3" style="max-width: 100%;">
                                        <h1 class="h3 text-gray-900">APLIKASI GUDANG</h1>
                                        <h1 class="h3 text-gray-900">PT THE ZAMRUD JEWELLERY</h1>
                                    </div>
                                    <?php if (count($_SESSION['error'])) : ?>
                                        <?php foreach ($_SESSION['error'] as $error) : ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?= $error; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <form action="" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" autocomplete="off" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="#">Lupa Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

</body>

</html>