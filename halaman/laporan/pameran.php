<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Laporan Pameran</h1>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <form action="halaman/cetak/pameran.php" method="POST" target="_blank">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        <div>
                            <?php if (!empty($_POST['id_petugas'])) : ?>
                                <input type="text" name="id_petugas" hidden value="<?= $_POST['id_petugas']; ?>">
                            <?php endif; ?>
                            <?php if (!empty($_POST['dari_tanggal']) && !empty($_POST['sampai_tanggal'])) : ?>
                                <input type="text" name="dari_tanggal" hidden value="<?= $_POST['dari_tanggal']; ?>">
                                <input type="text" name="sampai_tanggal" hidden value="<?= $_POST['sampai_tanggal']; ?>">
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-info">Cetak</button>
                    </div>
                </form>
                <form action="" method="POST">
                    <div class="card-body">
                        <div class="mb-3">
                            <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                            <label for="id_petugas" class="form-label">Petugas Yang Bertanggung Jawab</label>
                            <select name="id_petugas" id="id_petugas" class="form-control">
                                <option value="" selected disabled>Semua Petugas</option>
                                <?php while ($row = $petugas->fetch_assoc()) : ?>
                                    <option <?= $row['id'] == ($_POST['id_petugas'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" value="<?= $_POST['dari_tanggal'] ?? ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="dari_tanggal" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" value="<?= $_POST['sampai_tanggal'] ?? ''; ?>">
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
                                    <th class="text-center">Tanggal Mulai</th>
                                    <th class="text-center">Tanggal Selesai</th>
                                    <th class="text-center">Penanggung Jawab</th>
                                    <th class="text-center">Nama Pameran</th>
                                    <th class="text-center">Penyelenggara</th>
                                    <th class="text-center">Barang Pameran</th>
                                    <th class="text-center">Barang Terjual</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    pameran.*,
                                    petugas.nama nama_petugas,
                                    IFNULL((SELECT SUM(jumlah) FROM detail_pameran WHERE id_pameran=pameran.id), 0) jumlah_pameran,
                                    IFNULL((SELECT SUM(jumlah) FROM detail_penjualan_pameran dpp INNER JOIN penjualan_pameran pp ON dpp.id_penjualan_pameran=pp.id WHERE pp.id_pameran=pameran.id), 0) jumlah_terjual
                                FROM 
                                    pameran 
                                INNER JOIN 
                                    petugas 
                                ON 
                                    petugas.id=pameran.id_petugas 
                                WHERE 
                                    1=1 
                            ";

                            if (!empty($_POST['id_petugas'] ?? ''))
                                $q .= " AND pameran.id_petugas=" . $_POST['id_petugas'];
                            if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                                $q .= " AND (pameran.tanggal_mulai >='" . $_POST['dari_tanggal'] . "' AND pameran.tanggal_selesai <= '" . $_POST['dari_tanggal'] . "')";

                            $q .= " ORDER BY pameran.tanggal_mulai DESC, pameran.id DESC";
                            $result = $mysqli->query($q) or die($mysqli->error);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_mulai']); ?></td>
                                        <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_selesai']); ?></td>
                                        <td class="align-middle"><?= $row['nama_petugas']; ?></td>
                                        <td class="align-middle"><?= $row['nama']; ?></td>
                                        <td class="align-middle"><?= $row['penyelenggara']; ?></td>
                                        <td class="align-middle text-center"><?= $row['jumlah_pameran']; ?></td>
                                        <td class="align-middle text-center"><?= $row['jumlah_terjual']; ?></td>
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