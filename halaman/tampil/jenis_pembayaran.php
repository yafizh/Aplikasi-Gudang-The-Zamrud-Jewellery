<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Jenis Pembayaran</h1>
        <div>
            <!-- <a href="halaman/cetak/jenis_pembayaran.php" target="_blank" class="btn btn-danger btn-sm"><i class="far fa-file-pdf"></i>&nbsp;&nbsp;Cetak</a> -->
            <a href="?h=tambah_jenis_pembayaran" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
        </div>
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
                                    <th class="text-center">Jenis Pembayaran</th>
                                    <th class="text-center">Urutan</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $result = $mysqli->query("SELECT * FROM jenis_pembayaran");
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= $row['nama']; ?></td>
                                        <td class="align-middle text-center"><?= $row['urutan']; ?></td>
                                        <td class="text-center td-fit">
                                            <a href="?h=edit_jenis_pembayaran&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="?h=hapus_jenis_pembayaran&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
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