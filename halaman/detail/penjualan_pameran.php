<?php
$q = "
    SELECT 
        pp.*,
        pameran.nama nama_pameran,
        pameran.tempat,
        pameran.tanggal_mulai,
        pameran.tanggal_selesai,
        pameran.penyelenggara,
        petugas.nama nama_petugas
    FROM 
        penjualan_pameran pp  
    INNER JOIN 
        pameran 
    ON 
        pp.id_pameran=pameran.id 
    INNER JOIN 
        petugas 
    ON 
        pameran.id_petugas=petugas.id 
    WHERE 
    pp.id=" . $_GET['id'] . "
";
$data = $mysqli->query($q)->fetch_assoc();

$id_pameran = $mysqli->query("SELECT * FROM penjualan_pameran WHERE id=" . $_GET['id'])->fetch_assoc()['id_pameran'];
$q = "
    SELECT 
        dp.jumlah,
        dp.id_barang,
        jb.kode kode_jenis_barang, 
        b.kode, 
        b.satuan, 
        b.nama,
        IFNULL((SELECT jumlah FROM detail_penjualan_pameran WHERE id_penjualan_pameran=" . $_GET['id'] . " AND id_barang=dp.id_barang), 0) jumlah_dibeli 
    FROM 
        detail_pameran dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang 
    WHERE 
        dp.id_pameran=" . $id_pameran . "
";
$barang_pameran = $mysqli->query($q);
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembelian Barang Pameran</h1>
        <a href="?h=detail_pameran&id=<?= $data['id_pameran']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Pameran & Identitas Pembeli</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Pameran</label>
                                <input type="text" class="form-control" disabled value="<?= $data['nama_pameran']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control" disabled value="<?= $data['penyelenggara']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="id_petugas" class="form-label">Petugas Yang Bertanggung Jawab</label>
                                <input type="text" class="form-control" disabled value="<?= $data['nama_petugas']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Mulai Pameran</label>
                                <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal_mulai']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai Pameran</label>
                                <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal_selesai']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat</label>
                                <input type="text" class="form-control" disabled value="<?= $data['tempat']; ?>">
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">Nama Pembeli</label>
                                <input type="text" class="form-control" disabled value="<?= $data['nama']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" disabled value="<?= $data['nomor_telepon']; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Penjualan</label>
                                <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($data['tanggal']); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Pembayaran</label>
                                <input type="text" class="form-control" disabled value="<?= $data['jenis_pembayaran']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Barang Yang Dibeli</h6>
                        </div>
                        <div class="card-body">
                            <div id="container-pembelian-barang">
                                <?php while ($row = $barang_pameran->fetch_assoc()) : ?>
                                    <div class="row field-barang mb-3">
                                        <div class="mb-3 col-4">
                                            <label for="id_barang" class="form-label">Barang</label>
                                            <input type="text" class="form-control" disabled value="<?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']) . ': ' . $row['nama']; ?>">
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label>Jumlah Dipamerkan</label>
                                            <input type="number" class="form-control text-center" disabled value="<?= $row['jumlah']; ?>" />
                                        </div>
                                        <div class="mb-3 col-auto d-flex align-items-end">
                                            <label class="satuan"><?= $row['satuan']; ?></label>
                                        </div>
                                        <div class="mb-3 col-3">
                                            <label>Jumlah Pembelian</label>
                                            <input type="number" class="form-control text-center" disabled value="<?= $row['jumlah_dibeli']; ?>" />
                                        </div>
                                        <div class="mb-3 col-auto d-flex align-items-end">
                                            <label class="satuan"><?= $row['satuan']; ?></label>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>