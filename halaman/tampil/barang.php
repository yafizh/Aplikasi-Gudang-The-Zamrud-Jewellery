<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
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
                                    (SELECT IFNULL(COUNT(*), 0) FROM barang WHERE id_jenis_barang=jb.id) jumlah_barang
                                FROM 
                                    jenis_barang jb
                            ";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= $row['nama']; ?></td>
                                        <td class="align-middle text-center"><?= $row['jumlah_barang']; ?></td>
                                        <td class="text-center td-fit">
                                            <a href="?h=detail_barang&id_jenis_barang=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>