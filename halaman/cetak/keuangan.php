<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Keuangan</title>
    <link href="bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Keuangan</h4>
    <section class="px-3">
        <?php if (isset($_POST['id_toko'])) : ?>
            <?php $toko = $mysqli->query("SELECT * FROM toko WHERE id=" . $_POST['id_toko'])->fetch_assoc(); ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-12 col-sm-6">
                <table class="table">
                    <tr>
                        <th colspan="2">Filter</th>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Nama Toko</td>
                        <td class="pl-5">: <?= $toko['nama'] ?? 'Semua Toko'; ?></td>
                    </tr>
                    <tr>
                        <td class="align-middle td-fit">Tanggal</td>
                        <td class="pl-5">: <?= indonesiaDate($_POST['dari_tanggal']); ?> - <?= indonesiaDate($_POST['sampai_tanggal']); ?></td>
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
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">Nama Barang</th>
                    <th class="text-center align-middle">Banyak</th>
                    <th class="text-center align-middle">Harga Beli X Banyak</th>
                    <th class="text-center align-middle">Harga Jual X Banyak</th>
                    <th class="text-center align-middle">Diskon</th>
                    <th class="text-center align-middle">Laba Bersih</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "
                    SELECT 
                        DATE(pt.tanggal_waktu) tanggal,
                        b.nama nama_barang,
                        dpt.harga_toko,
                        dpt.harga_label,
                        dpt.diskon,
                        dpt.jumlah
                    FROM 
                        detail_penjualan_toko dpt 
                    INNER JOIN 
                        penjualan_toko pt 
                    ON 
                        pt.id=dpt.id_penjualan_toko 
                    INNER JOIN 
                        barang b
                    ON 
                        b.id=dpt.id_barang  
                    WHERE 
                    (
                        DATE(pt.tanggal_waktu) >='" . $_POST['dari_tanggal'] . "' 
                        AND 
                        DATE(pt.tanggal_waktu) <= '" . $_POST['sampai_tanggal'] . "'
                    ) 
                ";

                if (!empty($_POST['id_toko'] ?? ''))
                    $q .= " AND p.id=" . $_POST['id_toko'];

                $q .= " ORDER BY pt.tanggal_waktu DESC, pt.id DESC";
                $result = $mysqli->query($q) or die($mysqli->error);
                $no = 1;
                $total_jumlah = 0;
                $total_harga_toko = 0;
                $total_diskon = 0;
                $total_harga_label = 0;
                $total_harga_laba_bersih = 0;
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle text-center"><?= indonesiaDate($row['tanggal']); ?></td>
                            <td class="align-middle"><?= $row['nama_barang']; ?></td>
                            <td class="align-middle text-center"><?= $row['jumlah']; ?></td>
                            <td class="align-middle text-end">
                                <?= number_format($row['harga_toko'] * $row['jumlah'], 0, ",", "."); ?>
                            </td>
                            <td class="align-middle text-end">
                                <?= number_format($row['harga_label'] * $row['jumlah'], 0, ",", "."); ?>
                            </td>
                            <td class="align-middle text-end">
                                <?= number_format($row['diskon'], 0, ",", "."); ?>
                            </td>
                            <td class="align-middle text-end">
                                <?= number_format(
                                    ($row['harga_label'] * $row['jumlah']) - ($row['harga_toko'] * $row['jumlah']) - $row['diskon'],
                                    0,
                                    ",",
                                    "."
                                );
                                ?>
                            </td>
                        </tr>
                        <?php
                        $total_jumlah += $row['jumlah'];
                        $total_harga_toko += $row['harga_toko'] * $row['jumlah'];
                        $total_harga_label += $row['harga_label'] * $row['jumlah'];
                        $total_harga_laba_bersih += ($row['harga_label'] * $row['jumlah']) - ($row['harga_toko'] * $row['jumlah']) - $row['diskon'];
                        $total_diskon += $row['diskon'];
                        ?>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="3">Total</td>
                        <td class="text-center"><?= $total_jumlah; ?></td>
                        <td class="text-end"> <?= number_format($total_harga_toko, 0, ",", "."); ?></td>
                        <td class="text-end"> <?= number_format($total_harga_label, 0, ",", "."); ?></td>
                        <td class="text-end"> <?= number_format($total_diskon, 0, ",", "."); ?></td>
                        <td class="text-end"> <?= number_format($total_harga_laba_bersih, 0, ",", "."); ?></td>
                    </tr>
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