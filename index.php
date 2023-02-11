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
    <link rel="shortcut icon" href="assets/img/logo2.png" />

    <title>Aplikasi Gudang</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .td-fit {
            width: 1%;
            white-space: nowrap;
        }
    </style>
    <style>
        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            /* height: 28px; */
            height: 38px;
            user-select: none;
            -webkit-user-select: none;
            opacity: .55;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 8px;
            padding-top: 4px;
            padding-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: black !important;
        }
    </style>
    <script>
        const generateKodeBarang = function($number) {
            if ($number < 10)
                return ("00" + $number);
            else if ($number < 100)
                return ("0" + $number);
            else if ($number < 1000)
                return $number;
        }
    </script>
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
                            case "pegawai":
                                include_once "halaman/tampil/pegawai.php";
                                break;
                            case "jenis_barang":
                                include_once "halaman/tampil/jenis_barang.php";
                                break;
                            case "barang":
                                include_once "halaman/tampil/barang.php";
                                break;
                            case "barang_per_jenis_barang":
                                include_once "halaman/tampil/barang_per_jenis_barang.php";
                                break;
                            case "toko":
                                include_once "halaman/tampil/toko.php";
                                break;
                            case "distribusi_barang":
                                include_once "halaman/tampil/distribusi_barang.php";
                                break;
                            case "pemasok":
                                include_once "halaman/tampil/pemasok.php";
                                break;
                            case "penyuplaian":
                                include_once "halaman/tampil/penyuplaian.php";
                                break;
                            case "return_barang":
                                include_once "halaman/tampil/return_barang.php";
                                break;
                            case "pameran":
                                include_once "halaman/tampil/pameran.php";
                                break;
                            case "penjualan_toko":
                                include_once "halaman/tampil/penjualan_toko.php";
                                break;
                            case "toko-jenis_barang":
                                include_once "halaman/tampil/toko-jenis_barang.php";
                                break;
                            case "toko-jenis_barang-barang":
                                include_once "halaman/tampil/toko-jenis_barang-barang.php";
                                break;
                                // Detail
                            case "detail_distribusi_barang":
                                include_once "halaman/detail/distribusi_barang.php";
                                break;
                            case "detail_penyuplaian":
                                include_once "halaman/detail/penyuplaian.php";
                                break;
                            case "detail_return_barang":
                                include_once "halaman/detail/return_barang.php";
                                break;
                            case "detail_pameran":
                                include_once "halaman/detail/pameran.php";
                                break;
                            case "detail_penjualan_pameran":
                                include_once "halaman/detail/penjualan_pameran.php";
                                break;
                            case "detail_penjualan_toko":
                                include_once "halaman/detail/penjualan_toko.php";
                                break;
                                // Tambah
                            case "tambah_admin":
                                include_once "halaman/tambah/admin.php";
                                break;
                            case "tambah_petugas":
                                include_once "halaman/tambah/petugas.php";
                                break;
                            case "tambah_pegawai":
                                include_once "halaman/tambah/pegawai.php";
                                break;
                            case "tambah_jenis_barang":
                                include_once "halaman/tambah/jenis_barang.php";
                                break;
                            case "tambah_barang":
                                include_once "halaman/tambah/barang.php";
                                break;
                            case "tambah_toko":
                                include_once "halaman/tambah/toko.php";
                                break;
                            case "tambah_distribusi_barang":
                                include_once "halaman/tambah/distribusi_barang.php";
                                break;
                            case "tambah_pemasok":
                                include_once "halaman/tambah/pemasok.php";
                                break;
                            case "tambah_penyuplaian":
                                include_once "halaman/tambah/penyuplaian.php";
                                break;
                            case "tambah_return_barang":
                                include_once "halaman/tambah/return_barang.php";
                                break;
                            case "tambah_pameran":
                                include_once "halaman/tambah/pameran.php";
                                break;
                            case "tambah_penjualan_pameran":
                                include_once "halaman/tambah/penjualan_pameran.php";
                                break;
                            case "tambah_penjualan_toko":
                                include_once "halaman/tambah/penjualan_toko.php";
                                break;
                                // Edit
                            case "edit_admin":
                                include_once "halaman/edit/admin.php";
                                break;
                            case "edit_petugas":
                                include_once "halaman/edit/petugas.php";
                                break;
                            case "edit_pegawai":
                                include_once "halaman/edit/pegawai.php";
                                break;
                            case "edit_jenis_barang":
                                include_once "halaman/edit/jenis_barang.php";
                                break;
                            case "edit_barang":
                                include_once "halaman/edit/barang.php";
                                break;
                            case "edit_toko":
                                include_once "halaman/edit/toko.php";
                                break;
                            case "edit_distribusi_barang":
                                include_once "halaman/edit/distribusi_barang.php";
                                break;
                            case "edit_pemasok":
                                include_once "halaman/edit/pemasok.php";
                                break;
                            case "edit_penyuplaian":
                                include_once "halaman/edit/penyuplaian.php";
                                break;
                            case "edit_return_barang":
                                include_once "halaman/edit/return_barang.php";
                                break;
                            case "edit_pameran":
                                include_once "halaman/edit/pameran.php";
                                break;
                            case "edit_penjualan_pameran":
                                include_once "halaman/edit/penjualan_pameran.php";
                                break;
                            case "edit_penjualan_toko":
                                include_once "halaman/edit/penjualan_toko.php";
                                break;
                                // Hapus
                            case "hapus_admin":
                                include_once "halaman/hapus/admin.php";
                                break;
                            case "hapus_petugas":
                                include_once "halaman/hapus/petugas.php";
                                break;
                            case "hapus_pegawai":
                                include_once "halaman/hapus/pegawai.php";
                                break;
                            case "hapus_jenis_barang":
                                include_once "halaman/hapus/jenis_barang.php";
                                break;
                            case "hapus_barang":
                                include_once "halaman/hapus/barang.php";
                                break;
                            case "hapus_toko":
                                include_once "halaman/hapus/toko.php";
                                break;
                            case "hapus_distribusi_barang":
                                include_once "halaman/hapus/distribusi_barang.php";
                                break;
                            case "hapus_pemasok":
                                include_once "halaman/hapus/pemasok.php";
                                break;
                            case "hapus_penyuplaian":
                                include_once "halaman/hapus/penyuplaian.php";
                                break;
                            case "hapus_return_barang":
                                include_once "halaman/hapus/return_barang.php";
                                break;
                            case "hapus_pameran":
                                include_once "halaman/hapus/pameran.php";
                                break;
                            case "hapus_penjualan_pameran":
                                include_once "halaman/hapus/penjualan_pameran.php";
                                break;
                            case "hapus_penjualan_toko":
                                include_once "halaman/hapus/penjualan_toko.php";
                                break;
                                // Laporan
                            case "laporan_barang":
                                include_once "halaman/laporan/barang.php";
                                break;
                            case "laporan_distribusi_barang":
                                include_once "halaman/laporan/distribusi_barang.php";
                                break;
                            case "laporan_penyuplaian":
                                include_once "halaman/laporan/penyuplaian.php";
                                break;
                            case "laporan_return_barang":
                                include_once "halaman/laporan/return_barang.php";
                                break;
                            case "laporan_pameran":
                                include_once "halaman/laporan/pameran.php";
                                break;
                            case "laporan_penjualan_pameran":
                                include_once "halaman/laporan/penjualan_pameran.php";
                                break;
                            case "laporan_penjualan_toko":
                                include_once "halaman/laporan/penjualan_toko.php";
                                break;
                                // Ganti Password
                            case "ganti_password":
                                include_once "halaman/auth/ganti_password.php";
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

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Logout" dibawah apabila anda ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="halaman/auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('.barang').select2();
        });
    </script>
    <script src="assets/js/demo/chart-area-demo.js"></script>
</body>

</html>