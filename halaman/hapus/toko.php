<?php
if ($mysqli->query("DELETE FROM toko WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=toko';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
