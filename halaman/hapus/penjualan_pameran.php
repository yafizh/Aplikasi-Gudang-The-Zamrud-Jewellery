<?php
$data = $mysqli->query("SELECT * FROM penjualan_pameran WHERE id=" . $_GET['id'])->fetch_assoc();
if ($mysqli->query("DELETE FROM detail_penjualan_pameran WHERE id_penjualan_pameran=" . $_GET['id']) && $mysqli->query("DELETE FROM penjualan_pameran WHERE id=" . $_GET['id'])) {
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=detail_pameran&id=" . $data['id_pameran'] . "';</script>";
} else {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    die($mysqli->error);
}
