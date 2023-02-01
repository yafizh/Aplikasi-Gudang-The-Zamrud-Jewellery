<?php
$jenis_barang = $mysqli->query("SELECT * FROM jenis_barang WHERE id=" . $_GET['id_jenis_barang'])->fetch_assoc();
$barang = $mysqli->query("SELECT * FROM barang WHERE id_jenis_barang=" . $_GET['id_jenis_barang'] . " ORDER BY kode DESC")->fetch_assoc();

if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $harga_toko = $mysqli->real_escape_string($_POST['harga_toko']);
    $harga_label = $mysqli->real_escape_string($_POST['harga_label']);
    $stok = $mysqli->real_escape_string($_POST['stok']);
    $satuan = $mysqli->real_escape_string($_POST['satuan']);

    $q = "
        INSERT INTO barang(
            id_jenis_barang,
            kode,
            nama,
            harga_toko,
            harga_label,
            stok,
            satuan 
        ) VALUES (
            " . $_GET['id_jenis_barang'] . ",
            " . (($barang['kode'] ?? 0) + 1) . ",
            '$nama',
            '$harga_toko',
            '$harga_label',
            '$stok',
            '$satuan' 
        )
    ";
    if ($mysqli->query($q)) {
        $_SESSION['success'] = 'Tambah data berhasil!';
        echo "<script>location.href = '?h=barang_per_jenis_barang&id_jenis_barang=" . $_GET['id_jenis_barang'] . "';</script>";
    } else
        die($mysqli->error);
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
        <a href="?h=barang_per_jenis_barang&id_jenis_barang=<?= $_GET['id_jenis_barang']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Barang</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Jenis Barang</label>
                            <input type="text" class="form-control" disabled value="<?= $jenis_barang['nama']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" disabled value="<?= $jenis_barang['kode'] . generateKodeBarang(($barang['kode'] ?? 0) + 1); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_toko" class="form-label">Harga Modal</label>
                            <input type="text" class="form-control" id="harga_toko" name="harga_toko" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_label" class="form-label">Harga Label</label>
                            <input type="text" class="form-control" id="harga_label" name="harga_label" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" autocomplete="off" required>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>