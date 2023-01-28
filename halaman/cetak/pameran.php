<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pameran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Pameran</h4>
    <section class="px-3">
        <?php if (isset($_POST['id_petugas'])) : ?>
            <?php $petugas = $mysqli->query("SELECT * FROM petugas WHERE id=" . $_POST['id_petugas'])->fetch_assoc(); ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <table class="table">
                    <tr>
                        <th colspan="2">Filter</th>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Petugas Yang Bertanggung Jawab</td>
                        <td class="pl-5">: <?= $petugas['nama'] ?? 'Semua Petugas'; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tanggal</td>
                        <?php if (isset($_POST['dari_tanggal']) && isset($_POST['sampai_tanggal'])) : ?>
                            <td class="pl-5">: <?= indonesiaDate($_POST['dari_tanggal']); ?> - <?= indonesiaDate($_POST['sampai_tanggal']); ?></td>
                        <?php else : ?>
                            <td class="pl-5">: Semua Waktu</td>
                        <?php endif; ?>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="td-fit text-center align-middle">No</th>
                    <th class="text-center align-middle">Tanggal Mulai</th>
                    <th class="text-center align-middle">Tanggal Selesai</th>
                    <th class="text-center align-middle">Penanggung Jawab</th>
                    <th class="text-center align-middle">Nama Pameran</th>
                    <th class="text-center align-middle">Penyelenggara</th>
                    <th class="text-center align-middle">Barang Pameran</th>
                    <th class="text-center align-middle">Barang Terjual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "
                    SELECT 
                        pameran.*,
                        petugas.nama nama_petugas,
                        (SELECT SUM(jumlah) FROM detail_pameran WHERE id_pameran=pameran.id) jumlah_pameran,
                        (SELECT SUM(jumlah) FROM detail_penjualan_pameran dpp INNER JOIN penjualan_pameran pp ON dpp.id_penjualan_pameran=pp.id WHERE pp.id_pameran=pameran.id) jumlah_terjual
                    FROM 
                        pameran 
                    INNER JOIN 
                        petugas 
                    ON 
                        petugas.id=pameran.id_petugas 
                    WHERE 
                        1=1 
                ";

                if (!empty($_POST['id_petugas'] ?? ''))
                    $q .= " AND pameran.id_petugas=" . $_POST['id_petugas'];
                if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                    $q .= " AND (pameran.tanggal_mulai >='" . $_POST['dari_tanggal'] . "' AND pameran.tanggal_selesai <= '" . $_POST['dari_tanggal'] . "')";

                $q .= " ORDER BY pameran.tanggal_mulai DESC, pameran.id DESC";
                $result = $mysqli->query($q) or die($mysqli->error);
                $no = 1;
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_mulai']); ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_selesai']); ?></td>
                            <td class="align-middle"><?= $row['nama_petugas']; ?></td>
                            <td class="align-middle"><?= $row['nama']; ?></td>
                            <td class="align-middle"><?= $row['penyelenggara']; ?></td>
                            <td class="align-middle text-center"><?= $row['jumlah_pameran']; ?></td>
                            <td class="align-middle text-center"><?= $row['jumlah_terjual']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="8">Tidak Ada Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</body>

</html>