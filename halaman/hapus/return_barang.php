<?php 
if ($mysqli->query("DELETE FROM detail_return_barang WHERE id_return_barang=" . $_GET['id']) && $mysqli->query("DELETE FROM return_barang WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=return_barang';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
