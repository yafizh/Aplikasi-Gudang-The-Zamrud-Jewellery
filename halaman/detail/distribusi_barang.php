<?php
$q = "
    SELECT 
        distribusi_barang.*,
        toko.nama nama_toko,
        petugas.nama nama_petugas  
    FROM 
        distribusi_barang 
    INNER JOIN 
        toko 
    ON 
        toko.id=distribusi_barang.id_toko 
    INNER JOIN 
        petugas 
    ON 
        petugas.id=distribusi_barang.id_petugas
    WHERE 
        distribusi_barang.id=" . $_GET['id'];
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
        detail_distribusi_barang dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        dp.id_distribusi_barang=" . $_GET['id'] . "
";
$barang_disuplai = $mysqli->query($q);
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Detail Pendistribusian</h1>
        <a href="?h=distribusi_barang" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pendistribusian</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Toko Yang Menerima</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_toko']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Petugas Yang Menerima</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_petugas']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pendistribusian</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pendistribusian Barang</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-distribusi-barang">
                                    <?php while ($row = $barang_disuplai->fetch_assoc()) : ?>
                                        <div class="row field-barang mb-3">
                                            <div class="col-4">
                                                <label for="id_barang" class="form-label">Barang</label>
                                                <input type="text" class="form-control" disabled value="<?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']) . ': ' . $row['nama']; ?>">
                                            </div>
                                            <div class="col-3">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control text-center" disabled name="jumlah[]" autocomplete="off" value="<?= $row['jumlah']; ?>" />
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