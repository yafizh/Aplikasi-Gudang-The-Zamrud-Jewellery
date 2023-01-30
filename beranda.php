<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $jenis_barang = $mysqli->query("SELECT * FROM jenis_barang"); ?>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Jenis Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jenis_barang->num_rows; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $barang = $mysqli->query("SELECT * FROM barang"); ?>
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Jumlah Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $barang->num_rows; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $petugas = $mysqli->query("SELECT * FROM petugas"); ?>
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jumlah Petugas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $petugas->num_rows; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $pemasok = $mysqli->query("SELECT * FROM pemasok"); ?>
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Pemasok</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pemasok->num_rows; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Penyuplaian Barang 1 Tahun Terakhir</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->

    </div>
</div>
<?php
$bulan_tahun = [];
$bulan = (int)Date('m');
$tahun = (int)Date('Y');

for ($i = 0; $i < 12; $i++) {
    if ($bulan) {
        $bulan_tahun[] = [
            'bulan' => $bulan,
            'tahun' => $tahun
        ];
    }
    $bulan--;
    if ($bulan == 0) {
        $bulan = 12;
        $tahun--;
    }
}

$q = "
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[0]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[0]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[1]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[1]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[2]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[2]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[3]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[3]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[4]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[4]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[5]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[5]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[6]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[6]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[7]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[7]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[8]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[8]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[9]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[9]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[10]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[10]['tahun'] . "' 
    UNION ALL
    SELECT IFNULL(SUM(dp.jumlah), 0) jumlah FROM penyuplaian p INNER JOIN detail_penyuplaian dp ON dp.id_penyuplaian=p.id WHERE MONTH(p.tanggal)='" . $bulan_tahun[11]['bulan'] . "' AND YEAR(p.tanggal)='" . $bulan_tahun[11]['tahun'] . "' 
";
$data = $mysqli->query($q);
$penyuplaian = [];
foreach ($data as $value) {
    $penyuplaian[] = $value['jumlah'];
}
$penyuplaian = array_reverse($penyuplaian);

$bulan_penyuplaian = [];
foreach ($bulan_tahun as $value) {
    $bulan_penyuplaian[] = MONTH_IN_INDONESIA[$value['bulan'] - 1];
}
$bulan_penyuplaian = array_reverse($bulan_penyuplaian);
?>
<script>
    const penyuplaian = JSON.parse('<?= json_encode($penyuplaian) ?>');
    const bulan_penyuplaian = JSON.parse('<?= json_encode($bulan_penyuplaian) ?>');
</script>