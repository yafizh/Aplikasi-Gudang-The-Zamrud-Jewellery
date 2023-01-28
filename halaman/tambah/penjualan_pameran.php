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
        pameran.id_petugas=petugas.id 
    WHERE 
        pameran.id=" . $_GET['id_pameran'] . "
";
$pameran = $mysqli->query($q)->fetch_assoc();

$q = "
    SELECT 
        dp.jumlah,
        dp.id_barang,
        jb.kode kode_jenis_barang, 
        b.kode, 
        b.satuan, 
        b.nama 
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
        dp.id_pameran=" . $_GET['id_pameran'] . "
";
$barang_pameran = $mysqli->query($q);
if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $nomor_telepon = $mysqli->real_escape_string($_POST['nomor_telepon']);
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $jumlah = $_POST['jumlah'];

    try {
        $mysqli->begin_transaction();

        $q = "
            INSERT INTO penjualan_pameran (
                id_pameran,
                nama,
                nomor_telepon,
                tanggal  
            ) VALUES (
                '" . $_GET['id_pameran'] . "',
                '$nama',
                '$nomor_telepon',
                '$tanggal' 
            )
        ";
        $mysqli->query($q);

        $id_penjualan_pameran = $mysqli->insert_id;
        foreach ($barang_pameran as $i => $value) {
            $q = "
                INSERT INTO detail_penjualan_pameran (
                    id_penjualan_pameran,
                    id_barang,
                    jumlah 
                ) VALUES (
                    '$id_penjualan_pameran',
                    '" . $value['id_barang'] . "',
                    '" . $jumlah[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Tambah data penjualan pameran berhasil!';
        echo "<script>location.href = '?h=detail_pameran&id=" . $_GET['id_pameran'] . "';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pembelian Barang Pameran</h1>
        <a href="?h=detail_pameran&id=<?= $_GET['id_pameran']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pameran & Identitas Pembeli</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Nama Pameran</label>
                                    <input type="text" class="form-control" disabled value="<?= $pameran['nama']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control" disabled value="<?= $pameran['penyelenggara']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="id_petugas" class="form-label">Petugas Yang Bertanggung Jawab</label>
                                    <input type="text" class="form-control" disabled value="<?= $pameran['nama_petugas']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Mulai Pameran</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($pameran['tanggal_mulai']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Selesai Pameran</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($pameran['tanggal_selesai']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tempat</label>
                                    <input type="text" class="form-control" disabled value="<?= $pameran['tempat']; ?>">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Pembeli</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Penjualan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="off" value="<?= Date("Y-m-d"); ?>">
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
                                                <input type="number" class="form-control text-center" name="jumlah[]" required autocomplete="off" value="0" max="<?= $row['jumlah']; ?>" />
                                            </div>
                                            <div class="mb-3 col-auto d-flex align-items-end">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>