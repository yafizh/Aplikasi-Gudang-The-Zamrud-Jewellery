<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Laporan Penyuplaian</h1>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card shadow mb-4">
                <form action="halaman/cetak/penyuplaian.php" method="POST" target="_blank">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                        <div>
                            <?php if (!empty($_POST['id_jenis_barang'])) : ?>
                                <input type="text" name="id_jenis_barang" hidden value="<?= $_POST['id_jenis_barang']; ?>">
                            <?php endif; ?>
                            <?php if (!empty($_POST['id_pemasok'])) : ?>
                                <input type="text" name="id_pemasok" hidden value="<?= $_POST['id_pemasok']; ?>">
                            <?php endif; ?>
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
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <?php $pemasok = $mysqli->query("SELECT * FROM pemasok ORDER BY nama"); ?>
                                    <label for="id_pemasok" class="form-label">Pemasok</label>
                                    <select name="id_pemasok" id="id_pemasok" class="form-control">
                                        <option value="" selected disabled>Semua Pemasok</option>
                                        <?php while ($row = $pemasok->fetch_assoc()) : ?>
                                            <option <?= $row['id'] == ($_POST['id_pemasok'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                    <label for="id_petugas" class="form-label">Petugas Yang Menerima</label>
                                    <select name="id_petugas" id="id_petugas" class="form-control">
                                        <option value="" selected disabled>Semua Petugas</option>
                                        <?php while ($row = $petugas->fetch_assoc()) : ?>
                                            <option <?= $row['id'] == ($_POST['id_petugas'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang ORDER BY nama"); ?>
                                    <label for="id_jenis_barang" class="form-label">Jenis Barang</label>
                                    <select name="id_jenis_barang" id="id_jenis_barang" class="form-control">
                                        <option value="" selected disabled>Semua Jenis Barang</option>
                                        <?php while ($row = $jenis_barang->fetch_assoc()) : ?>
                                            <option <?= $row['id'] == ($_POST['id_jenis_barang'] ?? '') ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="dari_tanggal" class="form-label">Dari Tanggal</label>
                                    <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" value="<?= $_POST['dari_tanggal'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="dari_tanggal" class="form-label">Sampai Tanggal</label>
                                    <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" value="<?= $_POST['sampai_tanggal'] ?? ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end" style="gap: .5rem;">
                        <a href="?h=laporan_barang" class="btn btn-secondary">Reset</a>
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
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Pemasok</th>
                                    <th class="text-center">Petugas Yang Menerima</th>
                                    <th class="text-center">Jenis Barang</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">Nama Barang</th>
                                    <th class="text-center">Jumlah</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    penyuplaian.tanggal,
                                    pemasok.nama pemasok,
                                    petugas.nama petugas,
                                    jb.nama jenis_barang,
                                    jb.kode kode_jenis_barang,
                                    b.kode kode_barang,
                                    b.nama nama_barang,
                                    dp.jumlah 
                                FROM 
                                    detail_penyuplaian dp 
                                INNER JOIN 
                                    penyuplaian
                                ON 
                                    penyuplaian.id=dp.id_penyuplaian 
                                INNER JOIN 
                                    pemasok
                                ON 
                                    pemasok.id=penyuplaian.id_pemasok 
                                INNER JOIN 
                                    petugas
                                ON 
                                    petugas.id=penyuplaian.id_petugas 
                                INNER JOIN 
                                    barang b
                                ON 
                                    b.id=dp.id_barang  
                                INNER JOIN 
                                    jenis_barang jb 
                                ON 
                                    jb.id=b.id_jenis_barang 
                                WHERE 
                                    1=1 
                            ";

                            if (!empty($_POST['id_pemasok'] ?? ''))
                                $q .= " AND penyuplaian.id_pemasok=" . $_POST['id_pemasok'];
                            if (!empty($_POST['id_petugas'] ?? ''))
                                $q .= " AND penyuplaian.id_petugas=" . $_POST['id_petugas'];
                            if (!empty($_POST['id_jenis_barang'] ?? ''))
                                $q .= " AND b.id_jenis_barang=" . $_POST['id_jenis_barang'];
                            if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                                $q .= " AND (penyuplaian.tanggal >='" . $_POST['dari_tanggal'] . "' AND penyuplaian.tanggal <= '" . $_POST['dari_tanggal'] . "')";

                            $q .= " ORDER BY penyuplaian.tanggal DESC, penyuplaian.id DESC";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indonesiaDate($row['tanggal']); ?></td>
                                        <td class="align-middle text-center"><?= $row['pemasok']; ?></td>
                                        <td class="align-middle text-center"><?= $row['petugas']; ?></td>
                                        <td class="align-middle text-center"><?= $row['jenis_barang']; ?></td>
                                        <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode_barang']); ?></td>
                                        <td class="align-middle"><?= $row['nama_barang']; ?></td>
                                        <td class="align-middle text-center"><?= $row['jumlah']; ?></td>
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