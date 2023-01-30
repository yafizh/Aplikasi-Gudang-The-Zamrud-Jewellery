<?php
if (isset($_POST['submit'])) {
    $id_toko = $mysqli->real_escape_string($_POST['id_toko']);
    $id_petugas = $mysqli->real_escape_string($_POST['id_petugas']);
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    try {
        $mysqli->begin_transaction();

        $q = "
            INSERT INTO distribusi_barang (
                id_toko,
                id_petugas,
                tanggal  
            ) VALUES (
                '$id_toko',
                '$id_petugas',
                '$tanggal' 
            )
        ";
        $mysqli->query($q);

        $id_distribusi_barang = $mysqli->insert_id;
        foreach ($id_barang as $i => $id) {
            $q = "
                INSERT INTO detail_distribusi_barang (
                    id_distribusi_barang,
                    id_barang,
                    jumlah 
                ) VALUES (
                    '$id_distribusi_barang',
                    '" . $id . "',
                    '" . $jumlah[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Tambah data berhasil!';
        echo "<script>location.href = '?h=distribusi_barang';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pendistribusian</h1>
        <a href="?h=distribusi_barang" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pendistribusian</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $toko = $mysqli->query("SELECT * FROM toko ORDER BY nama"); ?>
                                    <label for="id_toko" class="form-label">Nama Toko Yang Menerima</label>
                                    <select name="id_toko" id="id_toko" class="form-control" required>
                                        <option value="" selected disabled>Pilih Toko</option>
                                        <?php while ($row = $toko->fetch_assoc()) : ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                    <label for="id_petugas" class="form-label">Petugas Yang Menerima</label>
                                    <select name="id_petugas" id="id_petugas" class="form-control" required>
                                        <option value="" selected disabled>Pilih Petugas</option>
                                        <?php while ($row = $petugas->fetch_assoc()) : ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pendistribusian</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="off" value="<?= Date("Y-m-d"); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pendistribusian Barang</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-distribusi-barang">
                                    <div class="row field-barang mb-3">
                                        <div class="col-4">
                                            <label for="id_barang" class="form-label">Barang</label>
                                            <select name="id_barang[]" id="id_barang" class="form-control barang" required>
                                                <option value="" selected disabled>Pilih Barang</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-style-1">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control text-center" name="jumlah[]" autocomplete="off" value="0" />
                                            </div>
                                        </div>
                                        <div class="col-2 d-flex align-items-end gap-2">
                                            <label class="satuan">Satuan</label>
                                        </div>
                                    </div>
                                    <div class="row field-barang mb-3">
                                        <div class="col-4">
                                            <label for="id_barang" class="form-label">Barang</label>
                                            <select name="id_barang[]" id="id_barang" class="form-control barang">
                                                <option value="" selected disabled>Pilih Barang</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control text-center" name="jumlah[]" autocomplete="off" value="0" />
                                        </div>
                                        <div class="col-2 d-flex align-items-end gap-2">
                                            <label class="satuan">Satuan</label>
                                        </div>
                                    </div>
                                    <div class="row field-barang mb-3">
                                        <div class="col-4">
                                            <label for="id_barang" class="form-label">Barang</label>
                                            <select name="id_barang[]" id="id_barang" class="form-control barang">
                                                <option value="" selected disabled>Pilih Barang</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control text-center" name="jumlah[]" autocomplete="off" value="0" />
                                        </div>
                                        <div class="col-2 d-flex align-items-end gap-2">
                                            <label class="satuan">Satuan</label>
                                        </div>
                                        <div class="col-3 d-flex align-items-end gap-2 button-container">
                                            <button onclick="addFieldBarang(this)" class="btn btn-success">Tambah</button>
                                        </div>
                                    </div>
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
<?php $barang = $mysqli->query("SELECT jb.kode kode_jenis_barang, b.* FROM barang b INNER JOIN jenis_barang jb ON jb.id=b.id_jenis_barang")->fetch_all(MYSQLI_ASSOC); ?>
<script>
    const containerDistribusiBarang = document.getElementById('container-distribusi-barang');
    const barang = JSON.parse('<?= json_encode($barang); ?>');
    const satuanBarang = document.querySelectorAll('.satuan');
    const barangTerpilih = [];
    const ignoreIndex = [];

    const addFieldBarang = (button) => {
        containerDistribusiBarang.insertAdjacentHTML('beforeend', `
            <div class="row field-barang mb-3">
                <div class="col-4">
                    <label for="id_barang" class="form-label">Barang</label>
                    <select name="id_barang[]" id="id_barang" class="form-control barang">
                        <option value="" selected disabled>Pilih Barang</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Jumlah</label>
                    <input type="number" class="form-control text-center" name="jumlah[]" autocomplete="off" value="0" />
                </div>
                <div class="col-2 d-flex align-items-end gap-2">
                    <label class="satuan">Satuan</label>
                </div>
                <div class="col-3 d-flex align-items-end button-container">
                    <button onclick="removeFieldBarang(this)" class="mr-3 btn btn-danger">Hapus</button>
                    <button onclick="addFieldBarang(this)" class="mr-3 btn btn-success add-field-button">Tambah</button>
                </div>
            </div>
        `);
        button.remove();
        setOptions();
    }

    const removeFieldBarang = (button) => {
        button.parentElement.parentElement.remove();
        if (!document.querySelector('.add-field-button')) {
            const semuaFieldBarang = document.querySelectorAll('.field-barang');
            semuaFieldBarang[semuaFieldBarang.length - 1].querySelector('.button-container').insertAdjacentHTML('beforeend', `<button onclick="addFieldBarang(this)" class="btn btn-success add-field-button">Tambah</button>`);
        }
        setOptions();
    }

    const setOptions = () => {
        document.querySelectorAll('.barang').forEach((element, index) => {
            if (!ignoreIndex.includes(index)) {
                element.innerHTML = '<option value="" selected disabled>Pilih Barang</option>';
                for (const key in barang) {
                    if (!barangTerpilih.includes(barang[key]['id'])) {
                        const option = document.createElement('option');
                        option.value = barang[key]['id'];
                        option.text = `${barang[key]['kode_jenis_barang']}${generateKodeBarang(barang[key]['kode'])}: ${barang[key]['nama']}`;
                        option.setAttribute('data-satuan', barang[key]['satuan']);
                        element.append(option);
                    }
                }
                element.addEventListener('change', () => {
                    barangTerpilih.push(element[element.selectedIndex].value);
                    satuanBarang[index].innerText = element[element.selectedIndex].getAttribute('data-satuan');
                    ignoreIndex.push(index);
                    setOptions();
                });
            }
        });
    }
    setOptions();
</script>