<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Data Pameran</h1>
        <a href="?h=tambah_pameran" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="td-fit text-center">No</th>
                                    <th class="text-center">Tanggal Kegiatan</th>
                                    <th class="text-center">Nama Pameran</th>
                                    <th class="text-center">Penananggung Jawab</th>
                                    <th class="text-center">Penyelenggara</th>
                                    <th class="td-fit text-center">Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            $q = "
                                SELECT 
                                    pameran.*,
                                    DATE(pameran.tanggal_mulai) tanggal_mulai,
                                    DATE(pameran.tanggal_selesai) tanggal_selesai,
                                    petugas.nama nama_petugas
                                FROM 
                                    pameran 
                                INNER JOIN 
                                    petugas 
                                ON 
                                    petugas.id=pameran.id_petugas 
                                ORDER BY 
                                    pameran.tanggal_mulai DESC, id DESC  
                            ";
                            $result = $mysqli->query($q);
                            $no = 1;
                            ?>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <tr>
                                        <td class="td-fit align-middle text-center"><?= $no++; ?></td>
                                        <td class="align-middle text-center"><?= indonesiaDate($row['tanggal_mulai']); ?> - <?= indonesiaDate($row['tanggal_selesai']); ?></td>
                                        <td class="align-middle"><?= $row['nama']; ?></td>
                                        <td class="align-middle"><?= $row['nama_petugas']; ?></td>
                                        <td class="align-middle"><?= $row['penyelenggara']; ?></td>
                                        <td class="text-center td-fit">
                                            <a title="Detail Pameran" href="?h=detail_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-info"><i class="far fa-eye"></i></a>
                                            <a href="?h=edit_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="?h=hapus_pameran&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>