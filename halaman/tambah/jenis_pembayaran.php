<?php
if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $urutan = $mysqli->real_escape_string($_POST['urutan']);

    $q = "INSERT INTO jenis_pembayaran (nama, urutan) VALUES ('$nama', '$urutan')";

    if ($mysqli->query($q)) {
        $_SESSION['success'] = 'Tambah data berhasil!';
        echo "<script>location.href = '?h=jenis_pembayaran';</script>";
    } else
        die($mysqli->error);
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Pembayaran</h1>
        <a href="?h=jenis_pembayaran" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Jenis Pembayaran</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Jenis Pembayaran</label>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="urutan" class="form-label">Urutan</label>
                            <input type="number" min="1" class="form-control" id="urutan" name="urutan" required autocomplete="off">
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