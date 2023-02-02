<?php
$q = "
    SELECT 
        penjualan_toko.*,
        toko.nama nama_toko
    FROM 
        penjualan_toko 
    INNER JOIN 
        toko 
    ON 
        toko.id=penjualan_toko.id_toko 
    WHERE 
        penjualan_toko.id=" . $_GET['id'];
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
        detail_penjualan_toko dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        dp.id_penjualan_toko=" . $_GET['id'] . "
";
$barang_didistribusi = $mysqli->query($q);
?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Detail Penjualan</h1>
        <a href="?h=penjualan_toko" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penjualan</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Toko</label>
                                    <input type="text" class="form-control" disabled value="<?= $data['nama_toko']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Penjualan</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal']); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penjualan Barang</h6>
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
                                            <?php while ($row = $barang_didistribusi->fetch_assoc()) : ?>
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