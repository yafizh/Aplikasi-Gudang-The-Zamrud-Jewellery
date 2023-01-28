<?php
$data = $mysqli->query("SELECT * FROM penyuplaian WHERE id=" . $_GET['id'])->fetch_assoc();
if (isset($_POST['submit'])) {
    $id_pemasok = $mysqli->real_escape_string($_POST['id_pemasok']);
    $id_petugas = $mysqli->real_escape_string($_POST['id_petugas']);
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    try {
        $mysqli->begin_transaction();

        $q = "
            UPDATE penyuplaian SET 
                id_pemasok='$id_pemasok',
                id_petugas='$id_petugas',
                tanggal='$tanggal' 
            WHERE 
                id=" . $_GET['id'] . "
        ";
        $mysqli->query($q);

        $mysqli->query("DELETE FROM detail_penyuplaian WHERE id_penyuplaian=" . $_GET['id']);
        foreach ($id_barang as $i => $id) {
            $q = "
                INSERT INTO detail_penyuplaian (
                    id_penyuplaian,
                    id_barang,
                    jumlah 
                ) VALUES (
                    '" . $_GET['id'] . "',
                    '" . $id . "',
                    '" . $jumlah[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Edit data berhasil!';
        echo "<script>location.href = '?h=penyuplaian';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Edit Penyuplaian</h1>
        <a href="?h=penyuplaian" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyupalain</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <?php $pemasok = $mysqli->query("SELECT * FROM pemasok ORDER BY nama"); ?>
                                    <label for="id_pemasok" class="form-label">Pemasok</label>
                                    <select name="id_pemasok" id="id_pemasok" class="form-control" required>
                                        <option value="" selected disabled>Pilih Pemasok</option>
                                        <?php while ($row = $pemasok->fetch_assoc()) : ?>
                                            <?php if ($data['id_pemasok'] == $row['id']) : ?>
                                                <option selected value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                    <label for="id_petugas" class="form-label">Petugas Yang Menerima</label>
                                    <select name="id_petugas" id="id_petugas" class="form-control" required>
                                        <option value="" selected disabled>Pilih Petugas</option>
                                        <?php while ($row = $petugas->fetch_assoc()) : ?>
                                            <?php if ($data['id_petugas'] == $row['id']) : ?>
                                                <option selected value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php else : ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Penyuplaian</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="off" value="<?= $data['tanggal']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Penyuplaian Barang</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-penyuplaian-barang"></div>
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
<?php
$q = "
    SELECT 
        dp.jumlah,
        b.id, 
        b.satuan, 
        jb.kode kode_jenis_barang,
        b.kode,
        b.nama 
    FROM 
        detail_penyuplaian dp 
    INNER JOIN 
        barang b 
    ON 
        b.id=dp.id_barang 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang
    WHERE 
        dp.id_penyuplaian=" . $_GET['id'] . "
";
$barang_disuplai = $mysqli->query($q)->fetch_all(MYSQLI_ASSOC); ?>
<script>
    const containerPenyuplaianBarnag = document.getElementById('container-penyuplaian-barang');
    const barang = JSON.parse('<?= json_encode($barang); ?>');
    const satuanBarang = document.querySelectorAll('.satuan');
    const barangTerpilih = [];
    const ignoreIndex = [];
    const barangDisuplai = JSON.parse('<?= json_encode($barang_disuplai); ?>');

    const addFieldBarang = (button) => {
        containerPenyuplaianBarnag.insertAdjacentHTML('beforeend', `
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

    for (let index = 0; index < Object.keys(barangDisuplai).length; index++) {
        barangTerpilih.push(barangDisuplai[index]['id']);
        ignoreIndex.push(index);
        containerPenyuplaianBarnag.insertAdjacentHTML('beforeend', `
            <div class="row field-barang mb-3">
                <div class="col-4">
                    <label for="id_barang" class="form-label">Barang</label>
                    <select name="id_barang[]" id="id_barang" class="form-control barang">
                        <option value="" disabled>Pilih Barang</option>
                        <option value="${barangDisuplai[index]['id']}" selected>${barangDisuplai[index]['kode_jenis_barang']}${generateKodeBarang(barangDisuplai[index]['kode'])}: ${barangDisuplai[index]['nama']}</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Jumlah</label>
                    <input type="number" class="form-control text-center" name="jumlah[]" autocomplete="off" value="${barangDisuplai[index]['jumlah']}" />
                </div>
                <div class="col-2 d-flex align-items-end gap-2">
                    <label class="satuan">${barangDisuplai[index]['satuan']}</label>
                </div>
                <div class="col-3 d-flex align-items-end button-container">
                    <button onclick="removeFieldBarang(this)" class="mr-3 btn btn-danger">Hapus</button>
                    ${(index == Object.keys(barangDisuplai).length-1) ? `<button onclick="addFieldBarang(this)" class="mr-3 btn btn-success add-field-button">Tambah</button>` : ``}                    
                </div>
            </div>
        `);
    }

    setOptions();
</script>