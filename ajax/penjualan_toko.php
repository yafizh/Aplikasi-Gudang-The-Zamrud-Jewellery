<?php

include '../db/koneksi.php';

$id_toko = $_GET['id_toko'];

$q = "
    SELECT 
        jb.nama nama_jenis_barang,
        jb.kode kode_jenis_barang, 
        b.nama,
        (SUM(ddb.jumlah) 
        - 
        IFNULL(
            (
                SELECT
                    SUM(dpt.jumlah) 
                FROM 
                    detail_penjualan_toko dpt 
                INNER JOIN 
                    penjualan_toko pt 
                ON 
                    pt.id=dpt.id_penjualan_toko 
                WHERE 
                    pt.id_toko=$id_toko 
                    AND 
                    dpt.id_barang=b.id
            ), 
        0)
        ) jumlah
    FROM 
        distribusi_barang db 
    INNER JOIN 
        detail_distribusi_barang ddb 
    ON 
        ddb.id_distribusi_barang=db.id 
    INNER JOIN 
        barang b 
    ON 
        b.id=ddb.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        db.id_toko=$id_toko 
        AND 
        ddb.id_barang=b.id 
    GROUP BY b.id 
    ORDER BY jb.nama 
";

$result = $mysqli->query($q);
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);