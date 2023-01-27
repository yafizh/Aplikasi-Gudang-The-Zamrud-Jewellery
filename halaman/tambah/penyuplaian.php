<?php
if (isset($_POST['submit'])) {
    $id_pemasok = $mysqli->real_escape_string($_POST['id_pemasok']);
    $id_petugas = $mysqli->real_escape_string($_POST['id_petugas']);
    $tanggal = $mysqli->real_escape_string($_POST['tanggal']);
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    try {
        $mysqli->begin_transaction();
        
        $q = "
            INSERT INTO penyuplaian (
                id_pemasok,
                id_petugas,
                tanggal  
            ) VALUES (
                '$id_pemasok',
                '$id_petugas',
                '$tanggal' 
            )
        ";
        $mysqli->query($q);

        $id_penyuplaian = $mysqli->insert_id;
        foreach ($id_barang as $i => $id) {
            $q = "
                INSERT INTO detail_penyuplaian (
                    id_penyuplaian,
                    id_barang,
                    jumlah 
                ) VALUES (
                    '$id_penyuplaian',
                    '" . $id . "',
                    '" . $jumlah[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Tambah data berhasil!';
        echo "<script>location.href = '?h=penyuplaian';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penyuplaian</h1>
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
                                    <label for="tanggal" class="form-label">Tanggal Penyuplaian</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required autocomplete="off" value="<?= Date("Y-m-d"); ?>">
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
                                <div id="container-penyuplaian-barang">
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
                                                <input type="number" class="form-control" name="jumlah[]" autocomplete="off" value="0" />
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
                                            <div class="input-style-1">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah[]" autocomplete="off" value="0" />
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
                                            <div class="input-style-1">
                                                <label>Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah[]" autocomplete="off" value="0" />
                                            </div>
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
<?php $barang = $mysqli->query("SELECT * FROM barang ORDER BY nama")->fetch_all(MYSQLI_ASSOC); ?>
<script>
    const containerPenyuplaianBarnag = document.getElementById('container-penyuplaian-barang');
    const barang = JSON.parse('<?= json_encode($barang); ?>');
    const satuanBarang = document.querySelectorAll('.satuan');
    const barangTerpilih = [];
    const ignoreIndex = [];

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
                    <div class="input-style-1">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah[]" autocomplete="off" value="0" />
                    </div>
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
                        option.text = barang[key]['nama'];
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