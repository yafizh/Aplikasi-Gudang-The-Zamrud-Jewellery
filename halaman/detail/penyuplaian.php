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
    WHERE 
        penyuplaian.id=" . $_GET['id'];
$data = $mysqli->query($q)->fetch_assoc();

$q = "
    SELECT 
        dp.jumlah,
        b.id, 
        b.satuan, 
        jb.kode kode_jenis_barang,
        b.kode, 
        b.nama 
    FROM 
        detail_penyuplaian dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        dp.id_penyuplaian=" . $_GET['id'] . "
";
$barang_disuplai = $mysqli->query($q);
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Detail Penyuplaian</h1>
        <a href="?h=penyuplaian" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyupalain</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="id_pemasok" class="form-label">Pemasok</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_pemasok']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="id_petugas" class="form-label">Petugas Yang Menerima</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_petugas']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Penyuplaian</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Penyuplaian Barang</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="td-fit text-center">No</th>
                                                <th class="text-center">Kode Barang</th>
                                                <th class="text-center">Nama Barang</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $no = 1;
                                        ?>
                                        <tbody>
                                            <?php while ($row = $barang_disuplai->fetch_assoc()) : ?>
                                                <tr>
                                                    <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                                    <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']); ?></td>
                                                    <td class="align-middle"><?= $row['nama']; ?></td>
                                                    <td class="align-middle text-center"><?= $row['jumlah']; ?> <?= $row['satuan']; ?></td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>