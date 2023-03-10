<?php
if (isset($_POST['submit'])) {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);

    $_SESSION['old']['username'] = $username;

    $validasi = $mysqli->query("SELECT username FROM pengguna WHERE username='$username'");
    if (!$validasi->num_rows) {
        $q = "INSERT INTO pengguna (username, password, status) VALUES ('$username', '$password', 'ADMIN')";

        if ($mysqli->query($q)) {
            $_SESSION['success'] = 'Tambah data berhasil!';
            echo "<script>location.href = '?h=admin';</script>";
        } else
            die($mysqli->error);
    } else
        $_SESSION['error'][] = "Username <strong>$username</strong> telah digunakan, username tidak dapat sama dengan admin yang lain.";
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Admin</h1>
        <a href="?h=admin" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Admin</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required autocomplete="off" value="<?= $_SESSION['old']['username'] ?? ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
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