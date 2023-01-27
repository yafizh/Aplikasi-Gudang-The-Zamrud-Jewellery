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
        b.nama 
    FROM 
        detail_penyuplaian dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
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
                                    <?php $pemasok = $mysqli->query("SELECT * FROM pemasok ORDER BY nama"); ?>
                                    <label for="id_pemasok" class="form-label">Pemasok</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_pemasok']; ?>">
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
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
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyuplaian Barang</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-penyuplaian-barang">
                                    <?php while ($row = $barang_disuplai->fetch_assoc()) : ?>
                                        <div class="row field-barang mb-3">
                                            <div class="col-4">
                                                <label for="id_barang" class="form-label">Barang</label>
                                                <input type="text" class="form-control" disabled value="<?= $row['nama']; ?>">
                                            </div>
                                            <div class="col-3">
                                                <div class="input-style-1">
                                                    <label>Jumlah</label>
                                                    <input type="number" class="form-control" disabled name="jumlah[]" autocomplete="off" value="<?= $row['jumlah']; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-2 d-flex align-items-end gap-2">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>