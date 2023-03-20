<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Petugas</title>
    <link href="bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Petugas</h4>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">NIK</th>
                    <th class="text-center align-middle">Nama</th>
                    <th class="text-center align-middle">Jabatan</th>
                    <th class="text-center align-middle">Nomor Telepon</th>
                    <th class="text-center align-middle">Tanggal Lahir</th>
                    <th class="text-center align-middle">Tempat Lahir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $mysqli->query("SELECT * FROM petugas");
                $no = 1;
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle text-center"><?= $row['nik']; ?></td>
                            <td class="align-middle"><?= $row['nama']; ?></td>
                            <td class="align-middle text-center"><?= $row['jabatan']; ?></td>
                            <td class="align-middle text-center"><?= $row['nomor_telepon']; ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_lahir']); ?></td>
                            <td class="align-middle text-center"><?= $row['tempat_lahir']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="7">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</body>

</html>