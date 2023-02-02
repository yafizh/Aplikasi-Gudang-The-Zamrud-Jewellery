<div class="container-fluid">

    <?php $toko = $mysqli->query("SELECT * FROM toko WHERE id=" . $_GET['id_toko'])->fetch_assoc(); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Pada <?= $toko['nama']; ?></h1>
        <a href="?h=toko" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
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
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Jumlah Barang</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    *,
                                    IFNULL((
                                        SELECT 
                                            COUNT(*) 
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
                                        INNER JOIN 
                                            barang b
                                        ON 
                                            ddb.id_barang=b.id 
                                        WHERE 
                                            b.id_jenis_barang=jb.id 
                                            AND 
                                            t.id=" . $toko['id'] . "
                                        GROUP BY b.id 
                                    ), 0) jumlah_barang
                                FROM 
                                    jenis_barang jb
                            ";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <?php if ((int)$row['jumlah_barang']) : ?>
                                        <tr>
                                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                            <td class="align-middle text-center"><?= $row['nama']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jumlah_barang']; ?></td>
                                            <td class="text-center td-fit">
                                                <a href="?h=toko-jenis_barang-barang&id_toko=<?= $toko['id']; ?>&id_jenis_barang=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                            </td>
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