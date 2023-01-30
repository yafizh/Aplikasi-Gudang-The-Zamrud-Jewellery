<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Penyupalaian</h1>
        <a href="?h=tambah_penyuplaian" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
                                    <th class="text-center">Pemasok</th>
                                    <th class="text-center">Petugas Yang Menerima</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    penyuplaian.*,
                                    pemasok.nama nama_pemasok,
                                    petugas.nama nama_petugas
                                FROM 
                                    penyuplaian 
                                INNER JOIN 
                                    pemasok 
                                ON 
                                    pemasok.id=penyuplaian.id_pemasok 
                                INNER JOIN 
                                    petugas 
                                ON 
                                    petugas.id=penyuplaian.id_petugas 
                            ";

                            if (!is_null($_SESSION['user']['id_petugas']))
                                $q .= " WHERE penyuplaian.id_petugas=" . $_SESSION['user']['id_petugas'];

                            $q .= " ORDER BY penyuplaian.tanggal DESC, penyuplaian.id DESC";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indoensiaDateWithDay($row['tanggal']); ?></td>
                                        <td class="align-middle"><?= $row['nama_pemasok']; ?></td>
                                        <td class="align-middle"><?= $row['nama_petugas']; ?></td>
                                        <td class="text-center td-fit">
                                            <a title="Return Barang" href="?h=tambah_return_barang&id_penyuplaian=<?= $row['id']; ?>" class="btn btn-sm btn-secondary"><i class="fas fa-people-carry"></i></a>
                                            <a title="Detail Penyuplaian" href="?h=detail_penyuplaian&id=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                            <a href="?h=edit_penyuplaian&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="?h=hapus_penyuplaian&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
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