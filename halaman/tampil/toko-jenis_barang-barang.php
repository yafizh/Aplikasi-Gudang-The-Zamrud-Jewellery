<?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang WHERE id=" . $_GET['id_jenis_barang'])->fetch_assoc(); ?>
<?php $toko = $mysqli->query("SELECT * FROM toko WHERE id=" . $_GET['id_toko'])->fetch_assoc(); ?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Jenis <?= $jenis_barang['nama']; ?> Pada Toko <?= $toko['nama']; ?></h1>
        <a href="?h=toko-jenis_barang&id_toko=<?= $toko['id']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="td-fit text-center">No</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jumlah Pendistribusian</th>
                                    <th class="text-center">Jumlah Terjual</th>
                                    <th class="text-center">Sisa Barang</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    jb.kode kode_jenis_barang, 
                                    b.*,
                                    IFNULL((
                                        SELECT 
                                            SUM(ddb.jumlah) 
                                        FROM 
                                            detail_distribusi_barang ddb 
                                        INNER JOIN 
                                            distribusi_barang db 
                                        ON 
                                            db.id=ddb.id_distribusi_barang 
                                        INNER JOIN 
                                            toko t 
                                        ON 
                                            t.id=db.id_toko 
                                        WHERE 
                                            b.id=jb.id 
                                            AND 
                                            t.id=" . $toko['id'] . "
                                        GROUP BY b.id 
                                    ), 0) jumlah_pendistribusian, 
                                    IFNULL((
                                        SELECT 
                                            SUM(ddb.jumlah) 
                                        FROM 
                                            detail_penjualan_toko ddb 
                                        INNER JOIN 
                                            penjualan_toko db 
                                        ON 
                                            db.id=ddb.id_penjualan_toko 
                                        INNER JOIN 
                                            toko t 
                                        ON 
                                            t.id=db.id_toko 
                                        WHERE 
                                            b.id=jb.id 
                                            AND 
                                            t.id=" . $toko['id'] . "
                                        GROUP BY b.id 
                                    ), 0) jumlah_terjual 
                                FROM 
                                    barang b 
                                INNER JOIN 
                                    jenis_barang jb 
                                ON 
                                    jb.id=b.id_jenis_barang 
                                WHERE 
                                    b.id_jenis_barang=" . $_GET['id_jenis_barang'];
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <?php if ((int)$row['jumlah_pendistribusian']) : ?>
                                        <tr>
                                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                            <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']); ?></td>
                                            <td class="align-middle text-center"><?= $row['nama']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jumlah_pendistribusian']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jumlah_terjual']; ?></td>
                                            <td class="align-middle text-center"><?= (int)$row['jumlah_pendistribusian'] - (int)$row['jumlah_terjual']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>