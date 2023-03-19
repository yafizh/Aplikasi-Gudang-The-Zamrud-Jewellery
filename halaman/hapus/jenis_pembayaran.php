<?php
if ($mysqli->query("DELETE FROM jenis_pembayaran WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=jenis_pembayaran';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
