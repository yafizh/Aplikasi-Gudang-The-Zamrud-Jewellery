<?php
try {
    $mysqli->begin_transaction();

    $result = $mysqli->query("SELECT * FROM detail_return_barang WHERE id_return_barang=" . $_GET['id']);
    while ($row = $result->fetch_assoc()) {
        if ($row['bentuk_penggantian_barang'] == "Uang")
            $mysqli->query("CALL after_delete_detail_return_barang(" . $row['id_barang'] . ", " . $row['jumlah'] . ")");
    }
    $mysqli->query("DELETE FROM return_barang WHERE id=" . $_GET['id']);

    $mysqli->commit();
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=return_barang';</script>";
} catch (\Throwable $e) {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    $mysqli->rollback();
    throw $e;
}
