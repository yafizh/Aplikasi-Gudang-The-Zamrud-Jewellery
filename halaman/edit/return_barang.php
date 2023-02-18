<?php
$q = "
SELECT 
    penyuplaian.tanggal tanggal_suplai,
    rb.tanggal tanggal_return_barang,
    pemasok.nama nama_pemasok,
    petugas.nama nama_petugas  
FROM 
    return_barang rb  
INNER JOIN 
    penyuplaian 
ON 
    penyuplaian.id=rb.id_penyuplaian  
INNER JOIN 
    pemasok 
ON 
    pemasok.id=penyuplaian.id_pemasok 
INNER JOIN 
    petugas 
ON 
    petugas.id=penyuplaian.id_petugas
WHERE 
    rb.id=" . $_GET['id'];
$return_barang = $mysqli->query($q)->fetch_assoc();

$q = "
    SELECT 
        drb.bentuk_penggantian_barang,
        drb.id_barang,
        drb.alasan,
        drb.jumlah jumlah_return,
        dp.jumlah jumlah_suplai,
        b.satuan, 
        jb.kode kode_jenis_barang,
        b.kode, 
        b.nama 
    FROM 
        detail_return_barang drb 
    INNER JOIN 
        return_barang rb  
    ON 
        rb.id=drb.id_return_barang
    INNER JOIN 
        penyuplaian p 
    ON 
        p.id=rb.id_penyuplaian 
    INNER JOIN 
        detail_penyuplaian dp 
    ON 
        dp.id_penyuplaian=p.id  
    INNER JOIN 
        barang b 
    ON 
        b.id=drb.id_barang=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        drb.id_return_barang=" . $_GET['id'] . "
";
$barang_direturn = $mysqli->query($q);
if (isset($_POST['submit'])) {
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $jumlah = $_POST['jumlah'];
    $alasan = $_POST['alasan'];
    $bentuk_penggantian_barang = $_POST['bentuk_penggantian_barang'];

    try {
        $mysqli->begin_transaction();

        $q = "
            UPDATE return_barang SET
                tanggal='$tanggal' 
            WHERE 
                id=" . $_GET['id'] . "
        ";
        $mysqli->query($q);

        $result = $mysqli->query("SELECT * FROM detail_return_barang WHERE id_return_barang=" . $_GET['id']);
        while ($row = $result->fetch_assoc()) {
            if ($row['bentuk_penggantian_barang'] == "Uang")
                $mysqli->query("CALL after_delete_detail_return_barang(" . $row['id_barang'] . ", " . $row['jumlah'] . ")");
        }
        $mysqli->query("DELETE FROM detail_return_barang WHERE id_return_barang=" . $_GET['id']);
        foreach ($barang_direturn as $i => $value) {
            $q = "
                INSERT INTO detail_return_barang (
                    id_return_barang,
                    id_barang,
                    jumlah,
                    alasan,
                    bentuk_penggantian_barang
                ) VALUES (
                    '" . $_GET['id'] . "',
                    '" . $value['id_barang'] . "',
                    '" . $jumlah[$i] . "',
                    '" . $alasan[$i] . "',
                    '" . $bentuk_penggantian_barang[$i] . "' 
                ) 
            ";
            $mysqli->query($q);

            if ($bentuk_penggantian_barang[$i] == "Uang")
                $mysqli->query("CALL after_insert_detail_return_barang(" . $value['id_barang'] . ", " . $jumlah[$i] . ")");
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Edit Return barang berhasil!';
        echo "<script>location.href = '?h=return_barang';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Edit Return Barang</h1>
        <a href="?h=return_barang" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
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
                                    <input type="text" class="form-control" disabled value="<?= $return_barang['nama_pemasok']; ?>">
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                    <label class="form-label">Petugas Yang Menerima</label>
                                    <input type="text" class="form-control" disabled value="<?= $return_barang['nama_petugas']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Penyuplaian</label>
                                    <input type="text" class="form-control" disabled value="<?= indoensiaDateWithDay($return_barang['tanggal_suplai']); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Return Barang</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $return_barang['tanggal_return_barang']; ?>">
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
                                    <?php while ($row = $barang_direturn->fetch_assoc()) : ?>
                                        <div class="row field-barang mb-3">
                                            <div class="mb-3 col-4">
                                                <label for="id_barang" class="form-label">Barang</label>
                                                <input type="text" class="form-control" disabled value="<?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']) . ': ' . $row['nama']; ?>">
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label>Jumlah Disuplai</label>
                                                <input type="number" class="form-control text-center" disabled value="<?= $row['jumlah_suplai']; ?>" />
                                            </div>
                                            <div class="mb-3 col-auto d-flex align-items-end">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                            <div class="mb-3 col-3">
                                                <label>Jumlah Return</label>
                                                <input type="number" class="form-control text-center" name="jumlah[]" required autocomplete="off" value="<?= $row['jumlah_return']; ?>" max="<?= $row['jumlah_suplai']; ?>" />
                                            </div>
                                            <div class="mb-3 col-auto d-flex align-items-end">
                                                <label class="satuan"><?= $row['satuan']; ?></label>
                                            </div>
                                            <div class="col-6">
                                                <label for="alasan">Alasan Return Barang</label>
                                                <input type="text" class="form-control" id="alasan" name="alasan[]" autocomplete="off" required value="<?= $row['alasan']; ?>">
                                            </div>
                                            <div class="col-6">
                                                <label for="bentuk_penggantian_barang">Bentuk Penggantian Barang</label>
                                                <select class="form-control" name="bentuk_penggantian_barang[]" id="bentuk_penggantian_barang">
                                                    <option value="" disabled selected>Pilih Bentuk Penggantian Barang</option>
                                                    <option <?= $row['bentuk_penggantian_barang'] == 'Barang Baru' ? 'selected' : ''; ?> value="Barang Baru">Barang Baru</option>
                                                    <option <?= $row['bentuk_penggantian_barang'] == 'Uang' ? 'selected' : ''; ?> value="Uang">Uang</option>
                                                </select>
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