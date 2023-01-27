<?php
if ($mysqli->query("DELETE FROM pemasok WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=pemasok';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
