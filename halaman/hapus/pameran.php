<?php 
try {
    $mysqli->begin_transaction();

    $penjualan_pameran = $mysqli->query("SELECT * FROM penjualan_pameran WHERE id_pameran=".$_GET['id']);

    foreach ($penjualan_pameran as $value) {
        $mysqli->query("DELETE FROM detail_penjualan_pameran WHERE id_penjualan_pameran=" . $value['id']); 
    }
    $mysqli->query("DELETE FROM pameran WHERE id=" . $_GET['id']);
    $mysqli->commit();
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=pameran';</script>";
} catch (\Throwable $e) {
    $mysqli->rollback();
    throw $e;
}