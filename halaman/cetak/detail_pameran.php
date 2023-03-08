<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Detail Pameran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Detail Pameran</h4>
    <section class="px-3">
        <?php $pameran = $mysqli->query("SELECT * FROM pameran WHERE id=" . $_GET['id'])->fetch_assoc(); ?>
        <div class="row">
            <div class="col-12 col-sm-6">
                <table class="table">
                    <tr>
                        <td class="align-middle td-fit">Nama Pameran</td>
                        <td class="pl-5">: <?= $pameran['nama']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tempat</td>
                        <td class="pl-5">: <?= $pameran['tempat']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Penyelenggara</td>
                        <td class="pl-5">: <?= $pameran['penyelenggara']; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tanggal Mulai</td>
                        <td class="pl-5">: <?= indonesiaDate($pameran['tanggal_mulai']); ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tanggal Selesai</td>
                        <td class="pl-5">: <?= indonesiaDate($pameran['tanggal_selesai']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
    <?php
    $q = "
        SELECT 
            dp.jumlah,
            jb.kode kode_jenis_barang, 
            b.*,
            (
                SELECT 
                    SUM(jumlah) 
                FROM 
                    detail_penjualan_pameran dpp 
                INNER JOIN 
                    penjualan_pameran pp 
                ON 
                    pp.id=dpp.id_penjualan_pameran
                WHERE 
                    pp.id_pameran=" . $_GET['id'] . " 
                    AND 
                    dpp.id_penjualan_pameran=pp.id  
                    AND 
                    id_barang=b.id
            ) jumlah_terjual 
        FROM 
            detail_pameran dp 
        INNER JOIN 
            barang b 
        ON 
            b.id=dp.id_barang 
        INNER JOIN 
            jenis_barang jb 
        ON 
            jb.id=b.id_jenis_barang 
        WHERE 
            dp.id_pameran=" . $_GET['id'] . "
    ";
    $barang_pameran = $mysqli->query($q);
    ?>
    <main class="p-3">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="td-fit text-center align-middle">No</th>
                    <th class="text-center align-middle">Barang</th>
                    <th class="text-center align-middle">Jumlah Barang</th>
                    <th class="text-center align-middle">Harga Modal</th>
                    <th class="text-center align-middle">Modal</th>
                    <th class="text-center align-middle">Harga Label</th>
                    <th class="text-center align-middle">Jumlah Terjual</th>
                    <th class="text-center align-middle">Jumlah Uang</th>
                    <th class="text-center align-middle">Keuntungan</th>
                    <th class="text-center align-middle">Sisa Barang</th>
                </tr>
            </thead>
            <?php
            $no = 1;
            $modal = 0;
            $untung = 0;
            $uang = 0;
            ?>
            <tbody>
                <?php while ($row = $barang_pameran->fetch_assoc()) : ?>
                    <tr>
                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                        <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']) . ': ' . $row['nama']; ?></td>
                        <td class="align-middle text-center"><?= $row['jumlah']; ?> <?= $row['satuan']; ?></td>
                        <td class="align-middle text-end"><?= number_format($row['harga_toko'], 0, ",", "."); ?></td>
                        <td class="align-middle text-end"><?= number_format((int)$row['jumlah'] * (int)$row['harga_toko'], 0, ",", "."); ?></td>
                        <td class="align-middle text-end"><?= number_format($row['harga_label'], 0, ",", "."); ?></td>
                        <td class="align-middle text-center"><?= $row['jumlah_terjual']; ?> <?= $row['satuan']; ?></td>
                        <td class="align-middle text-end"><?= number_format(((int)$row['jumlah_terjual'] * (int)$row['harga_label']), 0, ",", "."); ?></td>
                        <td class="align-middle text-end"><?= number_format(((int)$row['jumlah_terjual'] * (int)$row['harga_label']) - ((int)$row['jumlah_terjual'] * (int)$row['harga_toko']), 0, ",", "."); ?></td>
                        <td class="align-middle text-center"><?= (int)$row['jumlah'] - (int)$row['jumlah_terjual']; ?> <?= $row['satuan']; ?></td>
                    </tr>
                    <?php $modal += (int)$row['jumlah'] * (int)$row['harga_toko']; ?>
                    <?php $untung += (((int)$row['jumlah_terjual'] * (int)$row['harga_label']) - ((int)$row['jumlah_terjual'] * (int)$row['harga_toko'])); ?>
                    <?php $uang += ((int)$row['jumlah_terjual'] * (int)$row['harga_label']); ?>
                <?php endwhile; ?>
                <tr>
                    <th colspan="2">Total</th>
                    <td colspan="3" class="align-middle text-end"><b><?= number_format($modal, 0, ",", "."); ?></b></td>
                    <th colspan="3" class="align-middle text-end"><b><?= number_format($uang, 0, ",", "."); ?></b></th>
                    <td class="align-middle text-end"><b><?= number_format($untung, 0, ",", "."); ?></b></td>
                    <th></th>
                </tr>
            </tbody>
        </table>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</body>

</html>