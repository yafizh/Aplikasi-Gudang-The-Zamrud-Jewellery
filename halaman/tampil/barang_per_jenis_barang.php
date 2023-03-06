<?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang WHERE id=" . $_GET['id_jenis_barang'])->fetch_assoc(); ?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Barang Jenis <?= $jenis_barang['nama']; ?></h1>
        <div>
            <a href="?h=barang" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
            <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                <a href="?h=tambah_barang&id_jenis_barang=<?= $_GET['id_jenis_barang']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
            <?php endif; ?>
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
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Harga Modal</th>
                                    <th class="text-center">Harga Label</th>
                                    <th class="text-center">Stok</th>
                                    <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                                        <th class="td-fit text-center">Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <?php
                            $result = $mysqli->query("SELECT jb.kode kode_jenis_barang, b.* FROM barang b INNER JOIN jenis_barang jb ON jb.id=b.id_jenis_barang WHERE b.id_jenis_barang=" . $_GET['id_jenis_barang']);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']); ?></td>
                                        <td class="align-middle text-center"><?= $row['nama']; ?></td>
                                        <td class="align-middle text-right"><?= number_format($row['harga_toko'], 0, ",", "."); ?></td>
                                        <td class="align-middle text-right"><?= number_format($row['harga_label'], 0, ",", "."); ?></td>
                                        <td class="align-middle text-center"><?= $row['stok']; ?> <?= $row['satuan']; ?></td>
                                        <?php if ($_SESSION['user']['status'] == 'ADMIN') : ?>
                                            <td class="text-center td-fit">
                                                <a href="?h=edit_barang&id=<?= $row['id']; ?>&id_jenis_barang=<?= $row['id_jenis_barang']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                                <a href="?h=hapus_barang&id=<?= $row['id']; ?>&id_jenis_barang=<?= $row['id_jenis_barang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        <?php endif; ?>
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