<?php
if (isset($_POST['submit'])) {
    $nama = $mysqli->real_escape_string($_POST['nama']);
    $penyelenggara = $mysqli->real_escape_string($_POST['penyelenggara']);
    $id_petugas = $mysqli->real_escape_string($_POST['id_petugas']);
    $tanggal_mulai = $mysqli->real_escape_string($_POST['tanggal_mulai']);
    $tanggal_selesai = $mysqli->real_escape_string($_POST['tanggal_selesai']);
    $tempat = $mysqli->real_escape_string($_POST['tempat']);
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];

    try {
        $mysqli->begin_transaction();

        $q = "
            INSERT INTO pameran (
                id_petugas,
                nama,  
                tempat,  
                tanggal_mulai,  
                tanggal_selesai,  
                penyelenggara   
            ) VALUES (
                '$id_petugas',
                '$nama',
                '$tempat',
                '$tanggal_mulai',
                '$tanggal_selesai',
                '$penyelenggara' 
            )
        ";
        $mysqli->query($q);

        $id_pameran = $mysqli->insert_id;
        foreach ($id_barang as $i => $id) {
            $q = "
                INSERT INTO detail_pameran (
                    id_pameran,
                    id_barang,
                    jumlah 
                ) VALUES (
                    '$id_pameran',
                    '" . $id . "',
                    '" . $jumlah[$i] . "'
                ) 
            ";
            $mysqli->query($q);
        }


        $mysqli->commit();
        $_SESSION['success'] = 'Tambah data berhasil!';
        echo "<script>location.href = '?h=pameran';</script>";
    } catch (\Throwable $e) {
        $mysqli->rollback();
        throw $e;
    }
}
?>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pameran</h1>
        <a href="?h=pameran" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Pameran</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Pameran</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" required autocomplete="off">
                                </div>
                                <?php if (is_null($_SESSION['user']['id_petugas'])) : ?>
                                    <div class="mb-3">
                                        <?php $petugas = $mysqli->query("SELECT * FROM petugas ORDER BY nama"); ?>
                                        <label for="id_petugas" class="form-label">Petugas Yang Bertanggung Jawab</label>
                                        <select name="id_petugas" id="id_petugas" class="form-control" required>
                                            <option value="" selected disabled>Pilih Petugas</option>
                                            <?php while ($row = $petugas->fetch_assoc()) : ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                <?php else : ?>
                                    <div class="mb-3">
                                        <?php $petugas = $mysqli->query("SELECT * FROM petugas WHERE id=" . $_SESSION['user']['id_petugas'])->fetch_assoc(); ?>
                                        <label for="id_petugas" class="form-label">Petugas Yang Bertanggung Jawab</label>
                                        <input type="text" hidden name="id_petugas" id="id_petugas" value="<?= $petugas['id']; ?>" readonly>
                                        <input type="text" class="form-control" value="<?= $petugas['nama']; ?>" disabled>
                                    </div>
                                <?php endif; ?>
                                <div class="mb-3">
                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai Pameran</label>
                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required autocomplete="off" value="<?= Date("Y-m-d"); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_selesai" class="form-label">Tanggal Selesai Pameran</label>
                                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required autocomplete="off" value="<?= Date("Y-m-d"); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tempat" class="form-label">Tempat</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Form Barang Pameran</h6>
                            </div>
                            <div class="card-body">
                                <div id="container-barang-pameran">
                                    <div class="row field-barang mb-3">
                                        <div class="col-4">
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang" required>
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
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang">
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
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang">
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
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang">
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
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang">
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
                                            <label class="form-label">Barang</label>
                                            <select name="id_barang[]" class="form-control barang">
                                                <option value="" selected disabled>Pilih Barang</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control text-center" min="0" name="jumlah[]" autocomplete="off" value="0" />
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
<?php
$q = "
    SELECT 
        jb.nama nama_jenis_barang,
        jb.kode kode_jenis_barang, 
        b.* 
    FROM 
        barang b 
    INNER JOIN 
        jenis_barang jb 
    ON 
        jb.id=b.id_jenis_barang 
    ORDER BY 
        jb.nama";
$barang = $mysqli->query($q)->fetch_all(MYSQLI_ASSOC);
?>
<script>
    const containerBarnagPameran = document.getElementById('container-barang-pameran');
    const barang = JSON.parse('<?= json_encode($barang); ?>');
    const satuanBarang = document.querySelectorAll('.satuan');
    const barangTerpilih = [];
    const ignoreIndex = [];

    const addFieldBarang = (button) => {
        containerBarnagPameran.insertAdjacentHTML('beforeend', `
            <div class="row field-barang mb-3">
                <div class="col-4">
                    <label  class="form-label">Barang</label>
                    <select name="id_barang[]" class="form-control barang">
                        <option value="" selected disabled>Pilih Barang</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Jumlah</label>
                    <input type="number" class="form-control text-center" min="0" name="jumlah[]" autocomplete="off" value="0" />
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
                let optgroup = document.createElement('optgroup');
                let group = null;
                for (const key in barang) {
                    if (!barangTerpilih.includes(barang[key]['id'])) {
                        const option = document.createElement('option');
                        option.value = barang[key]['id'];
                        option.text = `${barang[key]['kode_jenis_barang']}${generateKodeBarang(barang[key]['kode'])}: ${barang[key]['nama']}`;
                        option.setAttribute('data-satuan', barang[key]['satuan']);
                        option.setAttribute('data-max', barang[key]['stok']);
                        optgroup.append(option);


                        // If total of barang is 1
                        if (Object.keys(barang).length == 1) {
                            optgroup.setAttribute('label', barang[key]['nama_jenis_barang']);
                            element.append(optgroup);
                            optgroup = document.createElement('optgroup');
                            break;
                        }

                        // If total of barang more than 1
                        if (key == (Object.keys(barang).length - 1)) {
                            optgroup.setAttribute('label', barang[key]['nama_jenis_barang']);
                            element.append(optgroup);
                            optgroup = document.createElement('optgroup');
                            break;
                        }
                        if (barang[key]['id_jenis_barang'] != barang[parseInt(key) + 1]['id_jenis_barang']) {
                            optgroup.setAttribute('label', barang[key]['nama_jenis_barang']);
                            element.append(optgroup);
                            optgroup = document.createElement('optgroup');
                        }

                    }
                }
                $(document).ready(function() {
                    $('.barang').select2();
                });
                $(element).on('select2:select', function(element2) {
                    barangTerpilih.push(element2.currentTarget[element2.currentTarget.selectedIndex].value);
                    document.querySelectorAll('.satuan')[index].innerText = element2.currentTarget[element2.currentTarget.selectedIndex].getAttribute('data-satuan');
                    document.querySelectorAll('input[name="jumlah[]"]')[index].setAttribute('max', element2.currentTarget[element2.currentTarget.selectedIndex].getAttribute('data-max'));
                    document.querySelectorAll('input[name="jumlah[]"]')[index].setAttribute('min', 0);
                    ignoreIndex.push(index);
                    setOptions();
                });
            }
        });

    }
    setOptions();
</script>