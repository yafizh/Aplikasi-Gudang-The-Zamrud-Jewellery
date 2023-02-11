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
(1, 'Batu Lepasan', 'NFBTL'),
(2, 'Cincin Emas', 'NFEMS'),
(3, 'Cincin Paladium', 'NFPLD'),
(4, 'Cincin Perak Berlian', 'NFPRB'),
(5, 'Cincin Perak Sirkon', 'NFPRS'),
(6, 'Dompet dan Tas', 'NFTND'),
(7, 'Makanan dan Minuman', 'NFDNF'),
(8, 'Gelang', 'NFGLG'),
(9, 'Kalung', 'NFKLG'),
(10, 'Minyak', 'NFMYK'),
(11, 'Souvenir', 'NFSOV'),
(12, 'Tasbih', 'NFTSB');

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
(1, 1, 1, 'BATU KELULUT', 120000, 140000, 0, 'PCS'),
(2, 1, 2, 'TIGER EYE', 120000, 140000, 0, 'PCS'),
(3, 1, 3, 'GIOK', 75000, 90000, 0, 'PCS'),
(4, 1, 4, 'BONGKAHAN KECUBUNG', 450000, 470000, 0, 'PCS'),
(5, 1, 5, 'SHAPPIRE 4.27 CT ', 1100000, 1120000, 0, 'PCS'),
(6, 1, 6, 'N.AMETHYST', 225000, 250000, 0, 'PCS'),
(7, 1, 7, 'VIRUS', 250000, 270000, 0, 'PCS'),
(8, 1, 8, 'KECUBUNG', 50000, 65000, 0, 'PCS'),
(9, 1, 9, 'MILKY AGATE', 50000, 65000, 0, 'PCS'),
(10, 1, 10, 'WHITE AGATE', 50000, 65000, 0, 'PCS'),
(11, 1, 11, 'GREEN AGATE', 50000, 65000, 0, 'PCS'),
(12, 1, 12, 'NATURAL EMERALD 2.51Ct (CUT)', 1500000, 1520000, 0, 'PCS'),
(13, 1, 13, 'NATURAL EMERALD 2.17Ct (CUT)', 1500000, 1520000, 0, 'PCS'),
(14, 1, 14, 'NATURAL EMERALD 2.77Ct (CUT)', 1500000, 1520000, 0, 'PCS'),
(15, 1, 15, 'NATURAL EMERALD 1.68Ct (CUT)', 1500000, 1520000, 0, 'PCS'),
(16, 2, 16, 'GIWANG MATA 16', 9000000, 9050000, 0, 'PCS'),
(17, 2, 17, 'GIWANG PENAMPAKAN MATA 7', 8599000, 8649000, 0, 'PCS'),
(18, 2, 18, 'GIWANG BATU RUBBY + BERLIAN', 43000000, 43050000, 0, 'PCS'),
(19, 2, 19, 'CC.PENAMPAKAN+TB', 16000000, 16050000, 0, 'PCS'),
(20, 2, 20, 'CC.PR.MATA 7', 16000000, 16050000, 0, 'PCS'),
(21, 2, 21, 'CC.PR.LISTRING', 4500000, 4550000, 0, 'PCS'),
(22, 2, 22, 'CC.PR.MATA 1', 3700000, 7400000, 0, 'PCS'),
(23, 2, 23, 'GIWANG MATA 7', 3499000, 7000000, 0, 'PCS'),
(24, 3, 24, 'CC.LK.BERLIAN KUNING MATA 4 + K', 6650000, 13300000, 0, 'PCS'),
(25, 3, 25, 'CC.LK SITRIN + BERLIAN ', 7500000, 15000000, 0, 'PCS'),
(26, 3, 26, 'CC.LK MATA 9', 8750000, 17500000, 0, 'PCS'),
(27, 3, 27, 'CC.LK MATA 9 + TB', 11550000, 23100000, 0, 'PCS'),
(28, 3, 28, 'CC.LK RUBBY + BERLIAN', 14600000, 29200000, 0, 'PCS'),
(29, 3, 29, 'CC.LK MATA 7 + KEL', 8680000, 17400000, 0, 'PCS'),
(30, 3, 30, 'CC.LK MATA 16', 5180000, 10400000, 0, 'PCS'),
(31, 3, 31, 'CC.LK BERLIAN HIJAU + B ', 8120000, 16500000, 0, 'PCS'),
(32, 3, 32, 'CC.LK YAKUT + B', 9450000, 16000000, 0, 'PCS'),
(33, 3, 33, 'CC.LK RUBBY + BERLIAN', 9250000, 18500000, 0, 'PCS'),
(34, 3, 34, 'CC.LK MATA 9', 6999500, 13999000, 0, 'PCS'),
(35, 3, 35, 'CC.LK BERLIAN KUNING MATA 9 + B', 6650000, 13300000, 0, 'PCS'),
(36, 3, 36, 'CC.LK NATURAL BLUE SAFIR', 8750000, 17500000, 0, 'PCS'),
(37, 3, 37, 'CC.LK.CAT EYE+B', 11250000, 22500000, 0, 'PCS'),
(38, 3, 38, 'CC.LK.BLUE SAFIR+B', 7500000, 15000000, 0, 'PCS'),

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