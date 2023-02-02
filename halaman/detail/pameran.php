<?php
$q = "
SELECT 
    pameran.*,
    petugas.nama nama_petugas  
FROM 
    pameran  
INNER JOIN 
    petugas 
ON 
    petugas.id=pameran.id_petugas
WHERE 
    pameran.id=" . $_GET['id'];
$data = $mysqli->query($q)->fetch_assoc();

$q = "
    SELECT 
        dp.jumlah,
        jb.kode kode_jenis_barang, 
        b.*,
        (
            SELECT 
                SUM(jumlah) 
            FROM 
                detail_penjualan_pameran dpp 
            INNER JOIN 
                penjualan_pameran pp 
            ON 
                pp.id=dpp.id_penjualan_pameran
            WHERE 
                pp.id_pameran=" . $_GET['id'] . " 
                AND 
                dpp.id_penjualan_pameran=pp.id  
                AND 
                id_barang=b.id
        ) jumlah_terjual 
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
        dp.id_pameran=" . $_GET['id'] . "
";
$barang_pameran = $mysqli->query($q);
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Detail Pameran</h1>
        <div>
            <a href="?h=pameran" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
            <a href="?h=tambah_penjualan_pameran&id_pameran=<?= $_GET['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Penjualan Pameran</a>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-cubes"></i>&nbsp;&nbsp;Barang Pameran</button>
            <a href="halaman/cetak/detail_pameran.php?id=<?= $_GET['id']; ?>" target="_blank" class="btn btn-danger btn-sm"><i class="far fa-file-pdf"></i>&nbsp;&nbsp;Cetak</a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Penyupalain & Return Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Pameran</label>
                                <input type="text" class="form-control" disabled value="<?= $data['nama']; ?>">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan Pameran</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="td-fit text-center">No</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Domisili</th>
                                    <th class="text-center">Nomor Telepon</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $result = $mysqli->query("SELECT * FROM penjualan_pameran WHERE id_pameran=" . $_GET['id'] . " ORDER BY tanggal DESC, id DESC");
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indonesiaDate($row['tanggal']); ?></td>
                                        <td class="align-middle"><?= $row['nama']; ?></td>
                                        <td class="align-middle"><?= $row['domisili']; ?></td>
                                        <td class="align-middle text-center"><?= $row['nomor_telepon']; ?></td>
                                        <td class="text-center td-fit">
                                            <a title="Detail Penjualan" href="?h=detail_penjualan_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                            <a href="?h=edit_penjualan_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="?h=hapus_penjualan_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
                                        </td>
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Barang Pameran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="td-fit text-center align-middle">No</th>
                            <th class="text-center align-middle">Barang</th>
                            <th class="text-center align-middle">Jumlah Barang</th>
                            <th class="text-center align-middle">Harga Modal</th>
                            <th class="text-center align-middle">Modal</th>
                            <th class="text-center align-middle">Harga Label</th>
                            <th class="text-center align-middle">Jumlah Terjual</th>
                            <th class="text-center align-middle">Keuntungan</th>
                            <th class="text-center align-middle">Sisa Barang</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    $modal = 0;
                    $untung = 0;
                    ?>
                    <tbody>
                        <?php while ($row = $barang_pameran->fetch_assoc()) : ?>
                            <tr>
                                <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']) . ': ' . $row['nama']; ?></td>
                                <td class="align-middle text-center"><?= $row['jumlah']; ?> <?= $row['satuan']; ?></td>
                                <td class="align-middle text-right"><?= number_format($row['harga_toko'], 0, ",", "."); ?></td>
                                <td class="align-middle text-right"><?= number_format((int)$row['jumlah'] * (int)$row['harga_toko'], 0, ",", "."); ?></td>
                                <td class="align-middle text-right"><?= number_format($row['harga_label'], 0, ",", "."); ?></td>
                                <td class="align-middle text-center"><?= $row['jumlah_terjual']; ?> <?= $row['satuan']; ?></td>
                                <td class="align-middle text-right"><?= number_format((int)$row['jumlah_terjual'] * (int)$row['harga_label'], 0, ",", "."); ?></td>
                                <td class="align-middle text-center"><?= (int)$row['jumlah'] - (int)$row['jumlah_terjual']; ?> <?= $row['satuan']; ?></td>
                            </tr>
                            <?php $modal += (int)$row['jumlah'] * (int)$row['harga_toko']; ?>
                            <?php $untung += (int)$row['jumlah_terjual'] * (int)$row['harga_label']; ?>
                        <?php endwhile; ?>
                        <tr>
                            <th colspan="2">Total</th>
                            <td colspan="3" class="align-middle text-right"><?= number_format($modal, 0, ",", "."); ?></td>
                            <td colspan="4" class="align-middle text-right"><?= number_format($untung, 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                            <th colspan="2">Laba Keuntungan Pameran</th>
                            <td colspan="7" class="align-middle text-right"><?= number_format(((($untung - $modal) > 0) ? ($untung - $modal) : "0"), 0, ",", "."); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>