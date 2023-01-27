<?php
if (isset($_POST['submit'])) {
    $nik = $mysqli->real_escape_string($_POST['nik']);
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $jabatan = $mysqli->real_escape_string($_POST['jabatan']);
    $nomor_telepon = $mysqli->real_escape_string($_POST['nomor_telepon']);
    $jenis_kelamin = $mysqli->real_escape_string($_POST['jenis_kelamin']);
    $tanggal_lahir = $mysqli->real_escape_string($_POST['tanggal_lahir']);
    $tempat_lahir = $mysqli->real_escape_string($_POST['tempat_lahir']);
    $tanggal_terdaftar = $mysqli->real_escape_string($_POST['tanggal_terdaftar']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $_SESSION['old']['nik'] = $nik;
    $_SESSION['old']['nama'] = $nama;
    $_SESSION['old']['jabatan'] = $jabatan;
    $_SESSION['old']['nomor_telepon'] = $nomor_telepon;
    $_SESSION['old']['jenis_kelamin'] = $jenis_kelamin;
    $_SESSION['old']['tanggal_lahir'] = $tanggal_lahir;
    $_SESSION['old']['tempat_lahir'] = $tempat_lahir;
    $_SESSION['old']['tanggal_terdaftar'] = $tanggal_terdaftar;

    $validasi = $mysqli->query("SELECT nik FROM petugas WHERE nik='$nik'");
    if (!$validasi->num_rows) {
        try {
            $mysqli->begin_transaction();

            $q = "INSERT INTO pengguna (username, password) VALUES ('$nik', '$password')";
            $mysqli->query($q);

            $q = "
                INSERT INTO petugas (
                    id_pengguna,
                    nik,
                    nama,
                    jabatan,
                    nomor_telepon,
                    jenis_kelamin,
                    tanggal_lahir,
                    tempat_lahir,
                    tanggal_terdaftar 
                ) VALUES (
                    '" . $mysqli->insert_id . "',
                    '$nik',
                    '$nama',
                    '$jabatan',
                    '$nomor_telepon',
                    '$jenis_kelamin',
                    '$tanggal_lahir',
                    '$tempat_lahir',
                    '$tanggal_terdaftar' 
                )
            ";
            $mysqli->query($q);


            $mysqli->commit();
            $_SESSION['success'] = 'Tambah data berhasil!';
            echo "<script>location.href = '?h=petugas';</script>";
        } catch (\Throwable $e) {
            $mysqli->rollback();
            throw $e;
        }
    } else
        $_SESSION['error'][] = "NIK <strong>$nik</strong> telah digunakan, nik tidak dapat sama dengan petugas yang lain.";
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Petugas</h1>
        <a href="?h=petugas" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <?php if (count($_SESSION['error'])) : ?>
                <?php foreach ($_SESSION['error'] as $error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Petugas</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" autocomplete="off" required value="<?= $_SESSION['old']['nik'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required value="<?= $_SESSION['old']['nama'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="jabatan" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" autocomplete="off" required value="<?= $_SESSION['old']['jabatan'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" autocomplete="off" required value="<?= $_SESSION['old']['nomor_telepon'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option <?= (($_SESSION['old']['jenis_kelamin'] ?? '') == 'Laki - Laki') ? 'selected' : ''; ?> value="Laki - Laki">Laki - Laki</option>
                                        <option <?= (($_SESSION['old']['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required autocomplete="off" value="<?= $_SESSION['old']['tanggal_lahir'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required autocomplete="off" value="<?= $_SESSION['old']['tempat_lahir'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_terdaftar" class="form-label">Tanggal Mulai Bekerja</label>
                                    <input type="date" class="form-control" id="tanggal_terdaftar" name="tanggal_terdaftar" required autocomplete="off" value="<?= $_SESSION['old']['tanggal_terdaftar'] ?? ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Akun Petugas</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" disabled name="username" value="<?= $_SESSION['old']['nik'] ?? ''; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
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
<script>
    document.querySelector('input[name=nik]').addEventListener('input', function() {
        document.querySelector('input[name=username]').value = this.value;
    });
</script>