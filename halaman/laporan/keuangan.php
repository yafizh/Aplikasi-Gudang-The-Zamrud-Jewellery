<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Laporan Keuangan</h1>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <form action="halaman/cetak/keuangan.php" method="POST" target="_blank">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        <div>
                            <?php if (!empty($_POST['id_toko'])) : ?>
                                <input type="text" name="id_toko" hidden value="<?= $_POST['id_toko']; ?>">
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
                            <?php $toko = $mysqli->query("SELECT * FROM toko ORDER BY nama"); ?>
                            <label for="id_toko" class="form-label">Nama Toko</label>
                            <select name="id_toko" id="id_toko" class="form-control">
                                <option value="" selected disabled>Semua Toko</option>
                                <?php while ($row = $toko->fetch_assoc()) : ?>
                                    <option <?= $row['id'] == ($_POST['id_toko'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
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
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Nama Barang</th>
                                        <th class="text-center">Banyak</th>
                                        <th class="text-center">Harga Beli X Banyak</th>
                                        <th class="text-center">Harga Jual X Banyak</th>
                                        <th class="text-center">Diskon</th>
                                        <th class="text-center">Nafa</th>
                                    </tr>
                                </thead>
                                <?php
                                $q = "
                                    SELECT 
                                        DATE(pt.tanggal_waktu) tanggal,
                                        b.nama nama_barang,
                                        dpt.harga_toko,
                                        dpt.harga_label,
                                        dpt.diskon,
                                        dpt.jumlah
                                    FROM 
                                        detail_penjualan_toko dpt 
                                    INNER JOIN 
                                        penjualan_toko pt 
                                    ON 
                                        pt.id=dpt.id_penjualan_toko 
                                    INNER JOIN 
                                        barang b
                                    ON 
                                        b.id=dpt.id_barang  
                                    WHERE 
                                    (
                                        DATE(pt.tanggal_waktu) >='" . $_POST['dari_tanggal'] . "' 
                                        AND 
                                        DATE(pt.tanggal_waktu) <= '" . $_POST['sampai_tanggal'] . "'
                                    ) 
                                ";

                                if (!empty($_POST['id_toko'] ?? ''))
                                    $q .= " AND p.id=" . $_POST['id_toko'];

                                $q .= " ORDER BY pt.tanggal_waktu DESC, pt.id DESC";
                                $result = $mysqli->query($q) or die($mysqli->error);
                                $no = 1;
                                ?>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                        <tr>
                                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal']); ?></td>
                                            <td class="align-middle"><?= $row['nama_barang']; ?></td>
                                            <td class="align-middle text-center"><?= $row['jumlah']; ?></td>
                                            <td class="align-middle text-end">
                                                <?= number_format($row['harga_toko'] * $row['jumlah'], 0, ",", "."); ?>
                                            </td>
                                            <td class="align-middle text-end">
                                                <?= number_format($row['harga_label'] * $row['jumlah'], 0, ",", "."); ?>
                                            </td>
                                            <td class="align-middle text-end">
                                                <?= number_format($row['diskon'], 0, ",", "."); ?>
                                            </td>
                                            <td class="align-middle text-end">
                                                <?= number_format(
                                                    ($row['harga_label'] * $row['jumlah']) - ($row['harga_toko'] * $row['jumlah']) - $row['diskon'],
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