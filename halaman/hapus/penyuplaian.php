<?php 
if ($mysqli->query("DELETE FROM detail_penyuplaian WHERE id_penyuplaian=" . $_GET['id']) && $mysqli->query("DELETE FROM penyuplaian WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=penyuplaian';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
