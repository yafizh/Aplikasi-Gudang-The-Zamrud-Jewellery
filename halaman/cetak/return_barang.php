<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Return Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Return Barang</h4>
    <section class="px-3">
        <?php if (isset($_POST['id_pemasok'])) : ?>
            <?php $pemasok = $mysqli->query("SELECT * FROM pemasok WHERE id=" . $_POST['id_pemasok'])->fetch_assoc(); ?>
        <?php endif; ?>
        <?php if (isset($_POST['id_jenis_barang'])) : ?>
            <?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang WHERE id=" . $_POST['id_jenis_barang'])->fetch_assoc(); ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
                <table class="table">
                    <tr>
                        <th colspan="2">Filter</th>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Pemasok</td>
                        <td class="pl-5">: <?= $pemasok['nama'] ?? 'Semua Pemasok'; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Jenis Barang</td>
                        <td class="pl-5">: <?= $jenis_barang['nama'] ?? 'Semua Jenis Barang'; ?></td>
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
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Tanggal Return</th>
                    <th class="text-center align-middle">Tanggal Penyupalain</th>
                    <th class="text-center align-middle">Pemasok</th>
                    <th class="text-center align-middle">Jenis Barang</th>
                    <th class="text-center align-middle">Kode Barang</th>
                    <th class="text-center align-middle">Nama Barang</th>
                    <th class="text-center align-middle">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "
                    SELECT 
                        rb.tanggal tanggal_return,
                        penyuplaian.tanggal tanggal_penyuplaian,
                        pemasok.nama pemasok,
                        jb.nama jenis_barang,
                        jb.kode kode_jenis_barang,
                        b.kode kode_barang,
                        b.nama nama_barang,
                        drp.jumlah 
                    FROM 
                        detail_return_barang drp 
                    INNER JOIN 
                        return_barang rb 
                    ON 
                        rb.id=drp.id_return_barang 
                    INNER JOIN 
                        penyuplaian
                    ON 
                        penyuplaian.id=rb.id_penyuplaian 
                    INNER JOIN 
                        pemasok
                    ON 
                        pemasok.id=penyuplaian.id_pemasok 
                    INNER JOIN 
                        barang b
                    ON 
                        b.id=drp.id_barang  
                    INNER JOIN 
                        jenis_barang jb 
                    ON 
                        jb.id=b.id_jenis_barang 
                    WHERE 
                        1=1 
                ";

                if (!empty($_POST['id_pemasok'] ?? ''))
                    $q .= " AND penyuplaian.id_pemasok=" . $_POST['id_pemasok'];
                if (!empty($_POST['id_jenis_barang'] ?? ''))
                    $q .= " AND b.id_jenis_barang=" . $_POST['id_jenis_barang'];
                if (!empty($_POST['dari_tanggal'] ?? '') && !empty($_POST['sampai_tanggal'] ?? ''))
                    $q .= " AND (rb.tanggal >='" . $_POST['dari_tanggal'] . "' AND rb.tanggal <= '" . $_POST['dari_tanggal'] . "')";

                $q .= " ORDER BY rb.tanggal DESC, rb.id DESC";
                $result = $mysqli->query($q) or die($mysqli->error);
                $no = 1;
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_return']); ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_penyuplaian']); ?></td>
                            <td class="align-middle text-center"><?= $row['pemasok']; ?></td>
                            <td class="align-middle text-center"><?= $row['jenis_barang']; ?></td>
                            <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode_barang']); ?></td>
                            <td class="align-middle"><?= $row['nama_barang']; ?></td>
                            <td class="align-middle text-center"><?= $row['jumlah']; ?></td>
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