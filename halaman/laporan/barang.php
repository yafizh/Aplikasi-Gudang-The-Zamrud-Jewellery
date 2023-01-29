<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Laporan Barang</h1>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <form action="halaman/cetak/barang.php" method="POST" target="_blank">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        <div>
                            <?php if (isset($_POST['id_jenis_barang'])) : ?>
                                <input type="text" name="id_jenis_barang" hidden value="<?= $_POST['id_jenis_barang']; ?>">
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-info">Cetak</button>
                    </div>
                </form>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="mb-3">
                            <?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang ORDER BY nama"); ?>
                            <label for="id_jenis_barang" class="form-label">Semua Jenis Barang</label>
                            <select name="id_jenis_barang" id="id_jenis_barang" class="form-control" required>
                                <option value="" selected disabled>Pilih Jenis Barang</option>
                                <?php while ($row = $jenis_barang->fetch_assoc()) : ?>
                                    <option <?= $row['id'] == ($_POST['id_jenis_barang'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end" style="gap: .5rem;">
                        <a href="" class="btn btn-secondary">Reset</a>
                        <button class="btn-primary btn">Filter</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="reportTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="td-fit text-center">No</th>
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Harga Toko</th>
                                    <th class="text-center">Harga Label</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Satuan</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    b.*,
                                    jb.kode kode_jenis_barang,
                                    jb.nama jenis_barang 
                                FROM 
                                    barang b
                                INNER JOIN 
                                    jenis_barang jb 
                                ON 
                                    jb.id=b.id_jenis_barang 
                            ";

                            if (isset($_POST['id_jenis_barang']))
                                $q .= " WHERE b.id_jenis_barang=" . $_POST['id_jenis_barang'];

                            $q .= " ORDER BY nama DESC";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= $row['jenis_barang']; ?></td>
                                        <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']); ?></td>
                                        <td class="align-middle"><?= $row['nama']; ?></td>
                                        <td class="align-middle text-right"><?= number_format($row['harga_toko'], 0, ",", "."); ?></td>
                                        <td class="align-middle text-right"><?= number_format($row['harga_label'], 0, ",", "."); ?></td>
                                        <td class="align-middle text-center"><?= $row['stok']; ?></td>
                                        <td class="align-middle text-center"><?= $row['satuan']; ?></td>
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