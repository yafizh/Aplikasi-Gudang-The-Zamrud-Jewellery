<?php
$data = $mysqli->query("SELECT * FROM pemasok WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $nomor_telepon = $mysqli->real_escape_string($_POST['nomor_telepon']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $alamat = $mysqli->real_escape_string($_POST['alamat']);
    $tanggal_terdaftar = $mysqli->real_escape_string($_POST['tanggal_terdaftar']);

    $q = "
        UPDATE pemasok SET 
            nama='$nama',  
            nomor_telepon='$nomor_telepon',
            email='$email',
            alamat='$alamat', 
            tanggal_terdaftar='$tanggal_terdaftar' 
        WHERE 
            id=" . $_GET['id'] . "
        ";

    if ($mysqli->query($q)) {
        $_SESSION['success'] = 'Edit data berhasil!';
        echo "<script>location.href = '?h=pemasok';</script>";
    } else
        die($mysqli->error);
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Edit Pemasok</h1>
        <a href="?h=pemasok" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Pemasok</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pemasok</label>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required autocomplete="off" value="<?= $data['nomor_telepon']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required autocomplete="off" value="<?= $data['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" autocomplete="off" id="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_terdaftar" class="form-label">Tanggal Terdaftar Sebagai Pemasok</label>
                            <input type="date" class="form-control" id="tanggal_terdaftar" name="tanggal_terdaftar" required autocomplete="off" value="<?= $data['tanggal_terdaftar']; ?>">
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