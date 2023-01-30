<?php
$data = $mysqli->query("SELECT * FROM toko WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $alamat = $mysqli->real_escape_string($_POST['alamat']);

    $q = "
        UPDATE toko SET 
            nama='$nama',  
            alamat='$alamat' 
        WHERE 
            id=" . $_GET['id'] . "
        ";

    if ($mysqli->query($q)) {
        $_SESSION['success'] = 'Edit data berhasil!';
        echo "<script>location.href = '?h=toko';</script>";
    } else
        die($mysqli->error);
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Edit Toko</h1>
        <a href="?h=toko" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Toko</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" autocomplete="off" id="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
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