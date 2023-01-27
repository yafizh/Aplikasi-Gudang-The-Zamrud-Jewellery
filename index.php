<?php session_start(); ?>
<?php require_once('db/koneksi.php'); ?>
<?php
$_SESSION['error'] = [];
$_SESSION['old'] = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Gudang</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .td-fit {
            width: 1%;
            white-space: nowrap;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include_once('templates/sidebar.php'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once('templates/navbar.php'); ?>
                <?php
                if (isset($_SESSION['user'])) {
                    if (isset($_GET['h'])) {
                        switch ($_GET['h']) {
                                // Tampil
                            case "admin":
                                include_once "halaman/tampil/admin.php";
                                break;
                            case "petugas":
                                include_once "halaman/tampil/petugas.php";
                                break;
                            case "jenis_barang":
                                include_once "halaman/tampil/jenis_barang.php";
                                break;
                                // Tambah
                            case "tambah_admin":
                                include_once "halaman/tambah/admin.php";
                                break;
                            case "tambah_petugas":
                                include_once "halaman/tambah/petugas.php";
                                break;
                            case "tambah_jenis_barang":
                                include_once "halaman/tambah/jenis_barang.php";
                                break;
                                // Hapus
                            case "edit_admin":
                                include_once "halaman/edit/admin.php";
                                break;
                            case "edit_petugas":
                                include_once "halaman/edit/petugas.php";
                                break;
                            case "edit_jenis_barang":
                                include_once "halaman/edit/jenis_barang.php";
                                break;
                                // Hapus
                            case "hapus_admin":
                                include_once "halaman/hapus/admin.php";
                                break;
                            case "hapus_petugas":
                                include_once "halaman/hapus/petugas.php";
                                break;
                            case "hapus_jenis_barang":
                                include_once "halaman/hapus/jenis_barang.php";
                                break;
                            default:
                                include_once "beranda.php";
                        }
                    } else include_once "beranda.php";
                } else
                    echo "<script>location.href = 'halaman/auth/login.php'</script>";
                ?>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="halaman/auth/logout.php">Logout</a>
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
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>