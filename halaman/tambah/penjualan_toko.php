<style>
    .plus:hover,
    .minus:hover {
        cursor: pointer;
    }

    .plus,
    .minus {
        cursor: pointer;
        font-size: 1.4rem;
    }
</style>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0 text-gray-800">Tambah Penjualan Toko</h1>
        <a href="?h=penjualan_toko" class="btn btn-secondary btn-sm"><i class="fas fa-caret-left"></i>&nbsp;&nbsp;Kembali</a>
    </div>

    <hr>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form action="" id="form-barang">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="kode_barang" class="form-label">Kode Barang</label>
                                                    <input type="text" class="form-control" id="kode_barang" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                                    <input type="text" class="form-control" id="nama_barang" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="mb-3">
                                                    <label for="diskon" class="form-label">Diskon</label>
                                                    <input type="text" class="form-control text-right" id="diskon" value="0" required>
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="mb-3">
                                                    <label for="kwantitas" class="form-label">Kwantitas</label>
                                                    <input type="number" class="form-control text-center" id="kwantitas" value="1" min="0" required>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <label for="exampleFormControlInput1" class="form-label" style="visibility: hidden;">Button</label>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="td-fit text-center align-middle">No</th>
                                            <th class="text-center align-middle">Kode Barang</th>
                                            <th class="text-center align-middle">Nama Barang</th>
                                            <th class="text-center align-middle">Harga</th>
                                            <th class="text-center align-middle">Kwantitas</th>
                                            <th class="text-center align-middle">Diskon</th>
                                            <th class="text-center align-middle">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle text-center" colspan="7">Data Kosong</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Penjualan Toko</h6>
                        </div>
                        <div class="card-body">
                            <form action="" id="form-checkout">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Penjualan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" required readonly autocomplete="off" value="<?= Date("Y-m-d"); ?>">
                                </div>
                                <div class="mb-3">
                                    <?php $jenis_pembayaran = $mysqli->query("SELECT * FROM jenis_pembayaran ORDER BY urutan"); ?>
                                    <label for="id_jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                                    <select name="id_jenis_pembayaran" id="id_jenis_pembayaran" required class="form-control">
                                        <option value="" selected disabled>Pilih Jenis Pembayaran</option>
                                        <?php while ($row = $jenis_pembayaran->fetch_assoc()) : ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="total" class="form-label">Total</label>
                                    <input type="text" class="form-control text-right" readonly name="total" id="total" required min="0" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="pembayaran" class="form-label">Pembayaran</label>
                                    <input type="text" class="form-control text-right" name="pembayaran" id="pembayaran" required min="0" value="0">
                                </div>
                                <div class="mb-3">
                                    <label for="kembalian" class="form-label">Kembalian</label>
                                    <input type="text" class="form-control text-right" readonly name="kembalian" id="kembalian" required min="0" value="0">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary">Lakukan Penjualan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SESSION['user']['status'] == 'PEGAWAI') {
    $id_toko = $mysqli->query("SELECT * FROM toko WHERE id_pegawai=" . $_SESSION['user']['id_pegawai'])->fetch_assoc()['id'];
    $q = "
        SELECT 
            jb.nama nama_jenis_barang,
            jb.kode kode_jenis_barang, 
            b.id,
            b.nama,
            b.kode,
            b.harga_label,
            b.harga_toko,
            b.satuan,
            (SUM(ddb.jumlah) 
            - 
            IFNULL(
                (
                    SELECT
                        SUM(dpt.jumlah) 
                    FROM 
                        detail_penjualan_toko dpt 
                    INNER JOIN 
                        penjualan_toko pt 
                    ON 
                        pt.id=dpt.id_penjualan_toko 
                    WHERE 
                        pt.id_toko=$id_toko 
                        AND 
                        dpt.id_barang=b.id
                ), 
            0)
            ) jumlah
        FROM 
            distribusi_barang db 
        INNER JOIN 
            detail_distribusi_barang ddb 
        ON 
            ddb.id_distribusi_barang=db.id 
        INNER JOIN 
            barang b 
        ON 
            b.id=ddb.id_barang 
        INNER JOIN 
            jenis_barang jb 
        ON 
            jb.id=b.id_jenis_barang
        WHERE 
            db.id_toko=$id_toko 
            AND 
            ddb.id_barang=b.id 
        GROUP BY b.id 
        ORDER BY jb.nama 
    ";
    $barang = $mysqli->query($q)->fetch_all(MYSQLI_ASSOC);
} else $barang = [];
?>
<script>
    const barang = JSON.parse('<?= json_encode($barang); ?>');
    const checkout = {
        id_toko: <?= json_encode($id_toko); ?>,
        id_barang: [],
        kode_barang: [],
        nama_barang: [],
        harga_label: [],
        harga_toko: [],
        kwantitas: [],
        diskon: [],
        total: [],
        pembayaran: 0,
        kembalian: 0,
        id_jenis_pembayaran: 0,
    };
    let index_barang = -1;

    const total = document.getElementById("total");
    const pembayaran = document.getElementById("pembayaran");
    const kembalian = document.getElementById("kembalian");

    const updateCheckout = () => {
        const totalReduce = checkout.total.reduce((a, b) => a + b);
        total.value = formatNumberWithDot.format(totalReduce);
        kembalian.value = formatNumberWithDot.format((checkout.pembayaran - totalReduce > 0) ? (checkout.pembayaran - totalReduce) : 0);
    }

    const updateKeranjang = () => {
        document.querySelector('tbody').innerHTML = '';
        checkout.kode_barang.forEach((value, index) => {
            document.querySelector('tbody').insertAdjacentHTML('beforeend', `
                <tr>
                    <td class="td-fit align-middle text-center">${index+1}</td>
                    <td class="align-middle text-center">${checkout.kode_barang[index]}</td>
                    <td class="align-middle">${checkout.nama_barang[index]}</td>
                    <td class="align-middle text-right">${formatNumberWithDot.format(checkout.harga_label[index])}</td>
                    <td class="align-middle text-center">
                        <a class="minus text-decoration-none">-</a>
                        <span class="mx-2">${checkout.kwantitas[index]}</span>
                        <a class="plus text-decoration-none">+</a>
                    </td>
                    <td class="align-middle text-right">${formatNumberWithDot.format(checkout.diskon[index])}</td>
                    <td class="align-middle text-right">${formatNumberWithDot.format(checkout.total[index])}</td>
                </tr>
            `);
        });
        minus();
        plus();
    }

    document.getElementById("kode_barang").addEventListener('input', function() {
        for (let index = 0; index < barang.length; index++) {
            if ((barang[index]['kode_jenis_barang'] + generateKodeBarang(barang[index]['kode'])) == this.value) {
                document.getElementById("nama_barang").value = barang[index].nama;
                index_barang = index;
                return;
            }

            document.getElementById("nama_barang").value = '';
            index_barang = -1;

        }
    });

    document.getElementById('diskon').addEventListener("keypress", function(evt) {
        if (evt.which < 48 || evt.which > 57) {
            evt.preventDefault();
            return;
        }

        this.addEventListener('input', function() {
            this.value = formatNumberWithDot.format(this.value.split('.').join(''));
        });
    });


    document.getElementById('pembayaran').addEventListener("keypress", function(evt) {
        if (evt.which < 48 || evt.which > 57) {
            evt.preventDefault();
            return;
        }

        this.addEventListener('input', function() {
            const nilai = parseInt(this.value.split('.').join(''));
            checkout.pembayaran = nilai;
            this.value = formatNumberWithDot.format(nilai);
            updateCheckout();
        });
    });

    const minus = () => {
        document.querySelectorAll('.minus').forEach((value, index) => {
            value.addEventListener('click', () => {
                checkout.kwantitas[index] -= 1;
                checkout.total[index] -= parseInt(checkout.harga_label[index]);
                if (checkout.kwantitas[index] == 0) {
                    if (index > -1) {
                        checkout.total[index] -= (parseInt(checkout.harga_label[index] * checkout.kwantitas[index] - checkout.diskon[index]));
                        checkout.kode_barang.splice(index, 1);
                        checkout.nama_barang.splice(index, 1);
                        checkout.harga_label.splice(index, 1);
                        checkout.harga_toko.splice(index, 1);
                        checkout.kwantitas.splice(index, 1);
                        checkout.diskon.splice(index, 1);
                    }
                }
                updateKeranjang();
                updateCheckout();
            });
        });
    }
    const plus = () => {
        document.querySelectorAll('.plus').forEach((value, index) => {
            value.addEventListener('click', () => {
                checkout.kwantitas[index] += 1;
                checkout.total[index] += parseInt(checkout.harga_label[index]);
                updateKeranjang();
                updateCheckout();
            });
        });
    }

    document.getElementById("form-barang").addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkout.kode_barang.includes(barang[index_barang].kode_jenis_barang + generateKodeBarang(barang[index_barang].kode))) {
            const tempIndex = checkout.kode_barang.indexOf((barang[index_barang].kode_jenis_barang + generateKodeBarang(barang[index_barang].kode)));
            checkout.kwantitas[tempIndex] += parseInt(document.getElementById('kwantitas').value);
            checkout.diskon[tempIndex] = parseInt(document.getElementById('diskon').value.split('.').join(''));
            checkout.total[tempIndex] = parseInt(checkout.harga_label[tempIndex] * checkout.kwantitas[tempIndex] - checkout.diskon[tempIndex]);
            checkout.total[tempIndex] = (parseInt(checkout.harga_label[checkout.harga_label.length - 1] * checkout.kwantitas[checkout.kwantitas.length - 1] - checkout.diskon[checkout.diskon.length - 1]));
        } else {
            checkout.id_barang.push(barang[index_barang].id);
            checkout.kode_barang.push(barang[index_barang].kode_jenis_barang + generateKodeBarang(barang[index_barang].kode));
            checkout.nama_barang.push(barang[index_barang].nama);
            checkout.harga_label.push(parseInt(barang[index_barang].harga_label));
            checkout.harga_toko.push(parseInt(barang[index_barang].harga_toko));
            checkout.kwantitas.push(parseInt(document.getElementById('kwantitas').value));
            checkout.diskon.push(parseInt(document.getElementById('diskon').value.split('.').join('')));
            checkout.total.push(parseInt(checkout.harga_label[checkout.harga_label.length - 1] * checkout.kwantitas[checkout.kwantitas.length - 1] - checkout.diskon[checkout.diskon.length - 1]));
        }
        updateKeranjang();
        updateCheckout();
    });
    document.getElementById("form-checkout").addEventListener('submit', async function(e) {
        e.preventDefault();
        checkout.id_jenis_pembayaran = document.getElementById('id_jenis_pembayaran').value;
        const response = await fetch('ajax/jual.php', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(checkout)
        }).then(response => response.json());
        if (response == 'success') {
            alert('success');
        }
    });
</script>