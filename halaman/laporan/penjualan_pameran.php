<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Laporan Penjualan Pameran</h1>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <form action="halaman/cetak/penjualan_pameran.php" method="POST" target="_blank">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        <div>
                            <?php if (!empty($_POST['id_pemaren'])) : ?>
                                <input type="text" name="id_pemaren" hidden value="<?= $_POST['id_pemaren']; ?>">
                            <?php endif; ?>
                            <?php if (!empty($_POST['dari_tanggal']) && !empty($_POST['sampai_tanggal'])) : ?>
                                <input type="text" name="dari_tanggal" hidden value="<?= $_POST['dari_tanggal']; ?>">
                                <input type="text" name="sampai_tanggal" hidden value="<?= $_POST['sampai_tanggal']; ?>">
                            <?php endif; ?>
                        </div>
                        <button type="submit" <?= isset($_POST['filter']) ? '' : 'disabled'; ?> class="btn btn-info">Cetak</button>
                    </div>
                </form>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="mb-3">
                            <?php $pameran = $mysqli->query("SELECT * FROM pameran ORDER BY nama"); ?>
                            <label for="id_pameran" class="form-label">Nama Pameran</label>
                            <select name="id_pameran" id="id_pameran" class="form-control">
                                <option value="" selected disabled>Semua Pameran</option>
                                <?php while ($row = $pameran->fetch_assoc()) : ?>
                                    <option <?= $row['id'] == ($_POST['id_pameran'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" required value="<?= $_POST['dari_tanggal'] ?? Date("Y-m-d"); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="dari_tanggal" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" required value="<?= $_POST['sampai_tanggal'] ?? Date("Y-m-d"); ?>">
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end" style="gap: .5rem;">
                        <a href="" class="btn btn-secondary">Reset</a>
                        <button name="filter" type="submit" class="btn-primary btn">Filter</button>
                    </div>
                </form>

            </div>
        </div>

        <?php if (isset($_POST['filter'])) : ?>
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="reportTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Penjualan</th>
                                        <th class="text-center">Nama Pameran</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Banyak</th>
                                        <th class="text-center">Harga Beli X Banyak</th>
                                        <th class="text-center">Harga Jual X Banyak</th>
                                        <th class="text-center">Laba Bersih</th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                SELECT 
                                    pp.tanggal,
                                    p.nama nama_pameran,
                                    pp.nama nama_pembeli,
                                    jb.nama jenis_barang,
                                    jb.kode kode_jenis_barang,
                                    b.nama nama_barang,
                                    b.kode kode_barang,
                                    dpp.jumlah,
                                    dpp.harga_toko,
                                    dpp.harga_label
                                FROM 
                                    detail_penjualan_pameran dpp 
                                INNER JOIN 
                                    penjualan_pameran pp 
                                ON 
                                    pp.id=dpp.id_penjualan_pameran 
                                INNER JOIN 
                                    pameran p 
                                ON 
                                    p.id=pp.id_pameran  
                                INNER JOIN 
                                    barang b
                                ON 
                                    b.id=dpp.id_barang  
                                INNER JOIN 
                                    jenis_barang jb 
                                ON 
                                    jb.id=b.id_jenis_barang 
                                WHERE 
                                (
                                    pp.tanggal >='" . $_POST['dari_tanggal'] . "' 
                                    AND 
                                    pp.tanggal <= '" . $_POST['sampai_tanggal'] . "'
                                ) 
                            ";

                                if (!empty($_POST['id_pameran'] ?? ''))
                                    $q .= " AND p.id=" . $_POST['id_pameran'];

                                $q .= " ORDER BY pp.tanggal DESC, pp.id DESC";
                                $result = $mysqli->query($q) or die($mysqli->error);
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal']); ?></td>
                                            <td class="align-middle"><?= $row['nama_pameran']; ?></td>
                                            <td class="align-middle"><?= $row['nama_barang']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jumlah']; ?></td>
                                            <td class="align-middle text-right">
                                                <?= number_format($row['harga_toko'] * $row['jumlah'], 0, ",", "."); ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= number_format($row['harga_label'] * $row['jumlah'], 0, ",", "."); ?>
                                            </td>
                                            <td class="align-middle text-right">
                                                <?= number_format(
                                                    ($row['harga_label'] * $row['jumlah']) - ($row['harga_toko'] * $row['jumlah']),
                                                    0,
                                                    ",",
                                                    "."
                                                );
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>