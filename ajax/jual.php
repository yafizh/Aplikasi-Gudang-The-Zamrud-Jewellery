<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
include '../db/koneksi.php';
$data = json_decode(file_get_contents('php://input'), true);

$id_toko = $mysqli->real_escape_string($data['id_toko']);
$id_jenis_pembayaran = $mysqli->real_escape_string($data['id_jenis_pembayaran']);
$pembayaran = $mysqli->real_escape_string($data['pembayaran']);
$tanggal_waktu = Date("Y-m-d H:i:s");

$id_barang = $data['id_barang'];
$jumlah = $data['kwantitas'];
$diskon = $data['diskon'];
$harga_toko = $data['harga_toko'];
$harga_label = $data['harga_label'];

try {
    $mysqli->begin_transaction();

    if (isset($_GET['id'])) {
        $q = "
            UPDATE penjualan_toko SET 
                id_jenis_pembayaran='$id_jenis_pembayaran',
                pembayaran='$pembayaran' 
            WHERE 
                id=" . $_GET['id'] . "
        ";
        $mysqli->query($q);
    } else {
        $q = "
            INSERT INTO penjualan_toko (
                id_toko,
                id_jenis_pembayaran,
                tanggal_waktu,
                pembayaran
            ) VALUES (
                '$id_toko',
                '$id_jenis_pembayaran',
                '$tanggal_waktu', 
                '$pembayaran' 
            )
        ";
        $mysqli->query($q);
    }

    if (isset($_GET['id'])) {
        $id_penjualan_toko = $_GET['id'];
        $mysqli->query("DELETE FROM detail_penjualan_toko WHERE id_penjualan_toko=$id_penjualan_toko");
    } else {
        $id_penjualan_toko = $mysqli->insert_id;
    }
    foreach ($id_barang as $i => $id) {
        $q = "
                INSERT INTO detail_penjualan_toko (
                    id_penjualan_toko,
                    id_barang,
                    jumlah,
                    harga_toko,
                    harga_label,
                    diskon
                ) VALUES (
                    '$id_penjualan_toko',
                    '" . $id . "',
                    '" . $jumlah[$i] . "',
                    '" . $harga_toko[$i] . "',
                    '" . $harga_label[$i] . "',
                    '" . $diskon[$i] . "' 
                ) 
            ";
        $mysqli->query($q);
    }


    $mysqli->commit();
    echo json_encode("success");
} catch (\Throwable $e) {
    $mysqli->rollback();
    throw $e;
}
