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
    penyuplaian.id=" . $_GET['id_penyuplaian'];
$penyuplaian = $mysqli->query($q)->fetch_assoc();

$q = "
    SELECT 
        dp.jumlah,
        dp.id_barang,
        b.satuan, 
        b.nama 
    FROM 
        detail_penyuplaian dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    WHERE 
        dp.id_penyuplaian=" . $_GET['id_penyuplaian'] . "
";
$barang_disuplai = $mysqli->query($q);
if (isset($_POST['submit'])) {
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $jumlah = $_POST['jumlah'];
    $alasan = $_POST['alasan'];

    try {
        $mysqli->begin_transaction();

        $q = "
            INSERT INTO return_barang (
                id_penyuplaian,
                tanggal  
            ) VALUES (
                '" . $_GET['id_penyuplaian'] . "',
                '$tanggal' 
            )
        ";
        $mysqli->query($q);

        $id_return_barang = $mysqli->insert_id;
        foreach ($barang_disuplai as $i => $value) {
            $q = "
                INSERT INTO detail_return_barang (
                    id_return_barang,
                    id_barang,
                    jumlah, 
                    alasan 
                ) VALUES (
                    '$id_return_barang',
                    '" . $value['id_barang'] . "',
                    '" . $jumlah[$i] . "',
                    '" . $alasan[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Return barang berhasil!';
        echo "<script>location.href = '?h=return_barang';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penyuplaian</h1>
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
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyupalain & Return Barang</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $pemasok = $mysqli->query("SELECT * FROM pemasok ORDER BY nama"); ?>
                                    <label class="form-label">Pemasok</label>
                                    <input type="text" class="form-control" disabled value="<?= $penyuplaian['nama_pemasok']; ?>">
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                    <label class="form-label">Petugas Yang Menerima</label>
                                    <input type="text" class="form-control" disabled value="<?= $penyuplaian['nama_petugas']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Penyuplaian</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($penyuplaian['tanggal']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Return Barang</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= Date('Y-m-d'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyuplaian Barang & Return Barang</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-penyuplaian-barang">
                                    <?php while ($row = $barang_disuplai->fetch_assoc()) : ?>
                                        <div class="row field-barang mb-3">
                                            <div class="mb-3 col-4">
                                                <label for="id_barang" class="form-label">Barang</label>
                                                <input type="text" class="form-control" disabled value="<?= $row['nama']; ?>">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label>Jumlah Disuplai</label>
                                                <input type="number" class="form-control text-center" disabled value="<?= $row['jumlah']; ?>" />
                                            </div>
                                            <div class="mb-3 col-auto d-flex align-items-end">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label>Jumlah Return</label>
                                                <input type="number" class="form-control text-center" name="jumlah[]" required autocomplete="off" value="0" max="<?= $row['jumlah']; ?>" />
                                            </div>
                                            <div class="mb-3 col-auto d-flex align-items-end">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                            <div class="col-12">
                                                <label for="alasan">Alasan Return Barang</label>
                                                <input type="text" class="form-control" id="alasan" name="alasan[]" required>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endwhile; ?>
                                </div>
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