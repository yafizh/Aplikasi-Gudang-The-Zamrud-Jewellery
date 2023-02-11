<?php
try {
    $mysqli->begin_transaction();

    $data = $mysqli->query("SELECT * FROM pegawai WHERE id=" . $_GET['id'])->fetch_assoc();
    $mysqli->query("DELETE FROM pengguna WHERE id=" . $data['id_pengguna']);

    $mysqli->commit();
    $_SESSION['success'] = 'Hapus data berhasil!';
    echo "<script>location.href = '?h=pegawai';</script>";
} catch (\Throwable $e) {
    echo "<script>alert('Hapus Data Gagal!')</script>";
    $mysqli->rollback();
    throw $e;
}
