<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Penjualan Toko</h1>
        <a href="?h=tambah_penjualan_toko" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="td-fit text-center">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama Toko</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    penjualan_toko.*,
                                    DATE(penjualan_toko.tanggal_waktu) tanggal,
                                    toko.nama nama_toko 
                                FROM 
                                    penjualan_toko 
                                INNER JOIN 
                                    toko 
                                ON 
                                    toko.id=penjualan_toko.id_toko 
                            ";

                            if ($_SESSION['user']['status'] == "PEGAWAI")
                                $q .= " WHERE toko.id_pegawai=" . $_SESSION['user']['id_pegawai'];

                            $q .= " ORDER BY penjualan_toko.tanggal_waktu DESC, penjualan_toko.id DESC";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indoensiaDateWithDay($row['tanggal']); ?></td>
                                        <td class="align-middle"><?= $row['nama_toko']; ?></td>
                                        <td class="text-center td-fit">
                                            <a title="Detail penjualan_toko" href="?h=detail_penjualan_toko&id=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                            <a href="?h=edit_penjualan_toko&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="?h=hapus_penjualan_toko&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
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