<?php 
if ($mysqli->query("DELETE FROM detail_distribusi_barang WHERE id_distribusi_barang=" . $_GET['id']) && $mysqli->query("DELETE FROM distribusi_barang WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=distribusi_barang';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
