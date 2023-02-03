INSERT INTO `db_gudang`.`pengguna` (
    id,
    username,
    password,
    status
) VALUES 
(1, 'admin', 'admin', 'ADMIN'),
(2, '11111111', '11111111', 'PETUGAS'),
(3, '22222222', '22222222', 'PETUGAS'),
(4, '33333333', '33333333', 'PEGAWAI'),
(5, '44444444', '44444444', 'PEGAWAI'),
(6, '55555555', '55555555', 'PEGAWAI'),
(7, '66666666', '66666666', 'PEGAWAI'),
(8, '77777777', '77777777', 'PEGAWAI');

INSERT INTO `db_gudang`.`petugas` (
    id,
    id_pengguna,
    nik,
    nama,
    jabatan,
    nomor_telepon,
    jenis_kelamin,
    tanggal_lahir,
    tempat_lahir,
    tanggal_terdaftar 
) VALUES 
(1, 2, '11111111', 'Petugas 1', 'Jabatan 1', '0895340832959', 'Laki - Laki', '2000-01-01', 'Martapura', CURRENT_DATE()),
(2, 3, '22222222', 'Petugas 2', 'Jabatan 2', '6468168136816', 'Perempuan', '2000-01-01', 'Martapura', CURRENT_DATE());

INSERT INTO `db_gudang`.`pegawai` (
    id,
    id_pengguna,
    nik,
    nama,
    jabatan,
    nomor_telepon,
    jenis_kelamin,
    tanggal_lahir,
    tempat_lahir,
    tanggal_terdaftar 
) VALUES 
(1, 4, '33333333', 'Pegawai 1', 'Jabatan 1', '0895340832959', 'Laki - Laki', '2000-01-01', 'Martapura', CURRENT_DATE()),
(2, 5, '44444444', 'Pegawai 2', 'Jabatan 2', '6468168136816', 'Perempuan', '2000-01-01', 'Martapura', CURRENT_DATE()),
(3, 6, '55555555', 'Pegawai 3', 'Jabatan 3', '6468168136816', 'Perempuan', '2000-01-01', 'Martapura', CURRENT_DATE()),
(4, 7, '66666666', 'Pegawai 4', 'Jabatan 3', '6468168136816', 'Perempuan', '2000-01-01', 'Martapura', CURRENT_DATE()),
(5, 8, '77777777', 'Pegawai 5', 'Jabatan 5', '6468168136816', 'Perempuan', '2000-01-01', 'Martapura', CURRENT_DATE());


INSERT INTO `db_gudang`.`jenis_barang` (
    id,
    nama,
    kode 
) VALUES 
(1, 'Bantal dan Boneka', 'NFBNK'),
(2, 'Batu Lepasan', 'NFBTL'),
(3, 'Cincin Emas', 'NFZOBTL'),
(4, 'Cincin Paladium', 'NFPLD'),
(5, 'Cincin Perak Berlian', 'NFPRB'),
(6, 'Cincin Perak Sirkon', 'NFPRS'),
(7, 'Cincin Swasa', 'NFSWASA'),
(8, 'Dompet dan Tas', 'NFTND'),
(9, 'Makanan dan Minuman', 'NFDNF'),
(10, 'Gelang', 'NFGLG'),
(12, 'Kalung', 'NFKLG'),
(13, 'Minyak', 'NFMYK'),
(14, 'Souvenir', 'NVSOV'),
(15, 'Tasbih', 'NFTSB');

INSERT INTO `db_gudang`.`barang` (
    id,
    id_jenis_barang,
    kode,
    nama,
    harga_toko,
    harga_label,
    stok,
    satuan
) VALUES 
(1, 1, 1, 'Bantal Polos', 45000, 90000, 0, 'PCS'), 
(2, 1, 2, 'Bantal Motif/Boneka', 50000, 100000, 0, 'PCS'), 
(3, 1, 3, 'Bantal Leher Printing', 60000, 120000, 0, 'PCS'), 
(4, 1, 4, 'Bantal/Boneka', 125000, 250000, 0, 'PCS'), 
(5, 2, 1, 'Kecubung', 26000, 75000, 0, 'PCS'), 
(6, 2, 2, 'Milky Agate', 50000, 100000, 0, 'PCS'), 
(7, 2, 3, 'White Agate', 50000, 100000, 0, 'PCS'), 
(8, 2, 4, 'Green Agate', 50000, 100000, 0, 'PCS'), 
(9, 2, 5, 'N.Amethyst 25,26 CT', 2525000, 5050000, 0, 'PCS'), 
(10, 2, 6, 'N.Amethyst 27,88 CT', 2800000, 5600000, 0, 'PCS'), 
(11, 2, 7, 'N.Amethyst 24,79 CT', 2475000, 4950000, 0, 'PCS'), 
(12, 2, 8, 'N.Amethyst 21,59 CT', 2150000, 4300000, 0, 'PCS'), 
(13, 2, 9, 'Natural Yellow Sapphire', 4600000, 9200000, 0, 'PCS'), 
(14, 2, 10, 'Natural Rubby 18.74 CT', 5150000, 10300000, 0, 'PCS');

INSERT INTO `db_gudang`.`toko` (
    id,
    id_pegawai,
    nama,
    alamat 
) VALUES 
(1, 1, 'Toko A', 'Jalan A'),
(2, 2, 'Toko B', 'Jalan B'),
(3, 3, 'Toko C', 'Jalan C'),
(4, 4, 'Toko D', 'Jalan D'),
(5, 5, 'Toko E', 'Jalan E');

INSERT INTO `db_gudang`.`pemasok` (
    id,
    nama,
    nomor_telepon,
    email,
    alamat,
    tanggal_terdaftar  
) VALUES 
(1, 'Pemasok 1', '0', 'email@example.com', 'Jalan A', CURRENT_DATE()),
(2, 'Pemasok 2', '0', 'email@example.com', 'Jalan B', CURRENT_DATE()),
(3, 'Pemasok 3', '0', 'email@example.com', 'Jalan C', CURRENT_DATE()),
(4, 'Pemasok 4', '0', 'email@example.com', 'Jalan D', CURRENT_DATE()),
(5, 'Pemasok 5', '0', 'email@example.com', 'Jalan E', CURRENT_DATE());

INSERT INTO `db_gudang`.`penyuplaian` (
    id,
    id_pemasok,
    id_petugas,
    tanggal 
) VALUES 
(1, 1, 1, CURRENT_DATE());

INSERT INTO `db_gudang`.`detail_penyuplaian` (
    id,
    id_penyuplaian,
    id_barang,
    jumlah 
) VALUES 
(1, 1, 1, 5),
(2, 1, 2, 5),
(3, 1, 3, 5);

-- INSERT INTO `db_gudang`.`return_barang` (
--     id,
--     id_penyuplaian,
--     tanggal 
-- ) VALUES 
-- (1, 1, CURRENT_DATE());

-- INSERT INTO `db_gudang`.`detail_return_barang` (
--     id,
--     id_return_barang,
--     id_barang,
--     jumlah,
--     alasan 
-- ) VALUES 
-- (1, 1, 1, 1, 'Barang Rusak');

-- INSERT INTO `db_gudang`.`pameran` (
--     id,
--     id_petugas,
--     nama,
--     tempat,
--     tanggal_mulai,
--     tanggal_selesai,
--     penyelenggara
-- ) VALUES 
-- (1, 1, 'The Jewellery', 'Banjarbaru', CURRENT_DATE(), CURRENT_DATE(), 'Pemerintah');

-- INSERT INTO `db_gudang`.`detail_pameran` (
--     id,
--     id_pameran,
--     id_barang,
--     jumlah
-- ) VALUES 
-- (1, 1, 1, 1);

-- INSERT INTO `db_gudang`.`penjualan_pameran` (
--     id,
--     id_pameran,
--     nama,
--     domisili,
--     nomor_telepon,
--     tanggal
-- ) VALUES 
-- (1, 1, 'Pembeli', 'Martapura', 'Nomor Telepon Pembeli', CURRENT_DATE());

-- INSERT INTO `db_gudang`.`detail_penjualan_pameran` (
--     id,
--     id_penjualan_pameran,
--     id_barang,
--     jumlah
-- ) VALUES 
-- (1, 1, 1, 1);