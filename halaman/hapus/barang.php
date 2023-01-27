<?php
if ($mysqli->query("DELETE FROM barang WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=barang_per_jenis_barang&id_jenis_barang=" . $_GET['id_jenis_barang'] . "';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
