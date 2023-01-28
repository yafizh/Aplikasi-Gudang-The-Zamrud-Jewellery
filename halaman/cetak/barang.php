<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../assets/img/logo2.png" />
</head>

<body>
    <?php include_once('../../templates/header.php'); ?>
    <h4 class="text-center my-3">Laporan Barang</h4>
    <?php if (isset($_POST['id_jenis_barang'])) : ?>
        <section class="px-3">
            <?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang WHERE id=" . $_POST['id_jenis_barang'])->fetch_assoc(); ?>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4">
                    <table class="table">
                        <tr>
                            <th colspan="2">Filter</th>
                        </tr>
                        <tr>
                            <td class="align-middle td-fit">Jenis Barang</td>
                            <td class="pl-5"><?= $jenis_barang['nama']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle td-fit">No</th>
                    <th class="text-center align-middle">Jenis Barang</th>
                    <th class="text-center align-middle">Kode Barang</th>
                    <th class="text-center align-middle">Nama Barang</th>
                    <th class="text-center align-middle">Harga Toko</th>
                    <th class="text-center align-middle">Harga Label</th>
                    <th class="text-center align-middle">Stok</th>
                    <th class="text-center align-middle">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = "
                    SELECT 
                        b.*,
                        jb.kode kode_jenis_barang,
                        jb.nama jenis_barang 
                    FROM 
                        barang b
                    INNER JOIN 
                        jenis_barang jb 
                    ON 
                        jb.id=b.id_jenis_barang 
                ";

                if (isset($_POST['id_jenis_barang']))
                    $q .= " WHERE b.id_jenis_barang=" . $_POST['id_jenis_barang'];

                $q .= " ORDER BY nama DESC";
                $result = $mysqli->query($q);
                $no = 1;
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle text-center"><?= $row['jenis_barang']; ?></td>
                            <td class="align-middle text-center"><?= $row['kode_jenis_barang'] . generateKodeBarang($row['kode']); ?></td>
                            <td class="align-middle"><?= $row['nama']; ?></td>
                            <td class="align-middle text-end"><?= number_format($row['harga_toko'], 0, ",", "."); ?></td>
                            <td class="align-middle text-end"><?= number_format($row['harga_label'], 0, ",", "."); ?></td>
                            <td class="align-middle text-center"><?= $row['stok']; ?></td>
                            <td class="align-middle text-center"><?= $row['satuan']; ?></td>
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