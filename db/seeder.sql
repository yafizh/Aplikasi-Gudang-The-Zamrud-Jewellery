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
(39, 4, 39, 'CC.PR CITRINE LISTRING', 1750000, 3000000, 0, 'PCS'),
(40, 4, 40, 'CC.PR BLUE SAFIR LISTRING', 1750000, 3000000, 0, 'PCS'),
(41, 4, 41, 'CC.LK ZAMRUD + BERLIAN', 6250000, 12500000, 0, 'PCS'),
(42, 4, 42, 'CC.LK PERAK BERLIAN', 5500000, 10000000, 0, 'PCS'),
(43, 4, 43, 'CC.LK BLUE SAFIR', 1750000, 3500000, 0, 'PCS'),
(44, 4, 44, 'CC.LK BERLIAN MATA 4', 9200000, 18400000, 0, 'PCS'),
(45, 4, 45, 'CC.LK ZAMRUD + BERLIAN', 6000000, 12000000, 0, 'PCS'),
(46, 4, 46, 'CC.PERAK BERLIAN', 5000000, 11000000, 0, 'PCS'),
(47, 4, 47, 'CC.LK BATU GARNET', 1875000, 3750000, 0, 'PCS'),
(48, 4, 48, 'CC.LK BERLIAN HITAM MATA 7', 2500000, 5000000, 0, 'PCS'),
(49, 4, 49, 'CC.LK YAKUT + B', 1500000, 3000000, 0, 'PCS'),
(50, 4, 50, 'CC.LK BERLIAN BIRU MATA 16', 2500000, 5000000, 0, 'PCS'),
(51, 4, 51, 'CC.LK PERAK BERLIAN', 5000000, 10000000, 0, 'PCS'),
(52, 4, 52, 'CC.LK ZAMRUD+ BERLIAN', 2250000, 4500000, 0, 'PCS'),
(53, 4, 53, 'CC.LK BERLIAN HITAM MATA 1+ B', 1875000, 3750000, 0, 'PCS'),
(54, 5, 54, 'CC.LK GREEN SAFIR +S', 1500000, 2000000, 0, 'PCS'),
(56, 5, 56, 'CC.LK GREEN SAFIR +S', 1500000, 3500000, 0, 'PCS'),
(57, 5, 57, 'CC.LK ZAMRUD+S', 2000000, 3700000, 0, 'PCS'),
(58, 5, 58, 'CC.LK YAKUT+S', 2600000, 5500000, 0, 'PCS'),
(59, 5, 59, 'CC.LK PINK SAFIR', 1250000, 4500000, 0, 'PCS'),
(60, 5, 60, 'CC.LK GREEN SAFIR +S', 1500000, 3500000, 0, 'PCS'),
(61, 5, 61, 'CC.LK ZAMRUD+S', 2000000, 3700000, 0, 'PCS'),
(62, 5, 62, 'CC.LK RUBBY+S', 1300000, 5000000, 0, 'PCS'),
(63, 5, 63, 'CC.LK BLUE SAFIR+S', 1000000, 2000000, 0, 'PCS'),
(64, 5, 64, 'CC.LK.GREEN SAFIR', 1500000, 3500000, 0, 'PCS'),
(65, 6, 65, 'DOMPET MANIK', 17500, 75000, 0, 'PCS'),
(66, 6, 66, 'DOMPET SASIRANGAN KOTAK', 160000, 250000, 0, 'PCS'),
(67, 6, 67, 'DOMPET SASIRANGAN OVAL', 140000, 350000, 0, 'PCS'),
(68, 6, 68, 'DOMPET SASIRANGAN HP', 80000, 200000, 0, 'PCS'),
(69, 6, 69, 'DOMPET PENSIL', 8500, 40500, 0, 'PCS'),
(70, 6, 70, 'TAS MANIK BERHEL', 150000, 500000, 0, 'PCS'),
(71, 6, 71, 'TAS TENUN BESAR', 45000, 150000, 0, 'PCS'),
(72, 6, 72, 'TAS TENUN KECIL', 28000, 90000, 0, 'PCS'),
(73, 6, 73, 'TAS SASIRANGAN PITA', 150000, 450000, 0, 'PCS'),
(74, 6, 74, 'TAS ROTAN BULAT SELEMPANG', 90000, 270000, 0, 'PCS'),
(75, 6, 75, 'TAS ROTAN KECIL SELEMPANG', 70000, 210000, 0, 'PCS'),
(77, 6, 77, 'TAS KECIL ECENG ONDOK', 30000, 90000, 0, 'PCS'),
(78, 6, 78, 'TAS PURUN HANDLE ECENG GONDOK', 105000, 210000, 0, 'PCS'),
(79, 6, 79, 'TAS PURUN POLOS HANDLE KULIT SINTETIS', 80000, 180000, 0, 'PCS'),
(80, 6, 80, 'TAS PURUN HANDLE KULIT SINTETIS DALAM HABUTAI', 115000, 230000, 0, 'PCS'),
(81, 7, 81, 'MADU BAJAKAH', 45000, 135000, 0, 'PCS'),
(82, 7, 82, 'MADU BAJAKAH SUPER', 50000, 175000, 0, 'PCS'),
(83, 7, 83, 'KOPI BANJAR 250Gr', 35000, 75000, 0, 'PCS'),
(84, 7, 84, 'TEH BAJAKAH ISI 15PCS', 17000, 50000, 0, 'PCS'),
(85, 7, 85, 'TEH BAJAKAH ISI 20PCS', 22500, 60000, 0, 'PCS'),
(86, 7, 86, 'TEH BAJAKAH ISI 30PCS', 25000, 90000, 0, 'PCS'),
(87, 7, 87, 'TEH BAJAKAH ISI 30PCS KALAWIT MERAH', 25000, 90000, 0, 'PCS'),
(88, 7, 88, 'KAYU BAJAKAH ½ KG', 20000, 60000, 0, 'PCS'),
(89, 7, 89, 'TEH BAWANG DAYAK ISI 15PCS', 17000, 50000, 0, 'PCS'),
(90, 7, 90, 'BAWANG DAYAK KERING', 25000, 75000, 0, 'PCS'),
(91, 7, 91, 'KAYU BAJAKAH KECIL ± 1ONS SET', 8000, 25000, 0, 'PCS'),
(92, 7, 92, 'KUE ROKO ', 20000, 40000, 0, 'PCS'),
(93, 7, 93, 'KACANG TELUR 300Gr', 25000, 50000, 0, 'PCS'),
(94, 7, 94, 'KUE BANGKIT', 20000, 40000, 0, 'PCS'),
(95, 8, 95, 'GELANG PUKAHA + HIU (ANAK)', 3500, 12500, 0, 'PCS'),
(96, 8, 96, 'GELANG ANEKA MANIK 1', 5000, 12500, 0, 'PCS'),
(97, 8, 97, 'GELANG SAWAN (ANAK)', 10000, 30000, 0, 'PCS'),
(98, 8, 98, 'GELANG BATU TALI ANYAM', 12500, 30000, 0, 'PCS'),
(99, 8, 99, 'GELANG ANEKA MANIK 2', 10000, 30000, 0, 'PCS'),
(100, 8, 100, 'GELANG DAYAK ', 10000, 60000, 0, 'PCS'),
(101, 8, 101, 'GELANG CRYSTAL', 10000, 30000, 0, 'PCS'),
(102, 8, 102, 'GELANG CRYSTAL ANAK', 10000, 30000, 0, 'PCS'),
(103, 8, 103, 'GELANG HURUF', 20000, 50000, 0, 'PCS'),
(104, 8, 104, 'GELANG CRYSTAL BATU', 15000, 50000, 0, 'PCS'),
(105, 8, 105, 'GELANG BATU 8ML', 10000, 60000, 0, 'PCS'),
(106, 8, 106, 'GELANG AKIK SULAIMAN', 14000, 50000, 0, 'PCS'),
(107, 8, 107, 'GELANG GAHARU 6ML', 6500, 25000, 0, 'PCS'),
(108, 8, 108, 'GELANG GAHARU 8ML', 7500, 50000, 0, 'PCS'),
(109, 8, 109, 'GELANG GIOK TALI ANYAM ', 6000, 30000, 0, 'PCS'),
(110, 9, 110, 'KALUNG BATU 1', 45000, 150000, 0, 'PCS'),
(111, 9, 111, 'KALUNG BATU 2', 60000, 180000, 0, 'PCS'),
(112, 9, 112, 'KALUNG LIONTIN BATU ', 25000, 75000, 0, 'PCS'),
(113, 9, 113, 'KALUNG FASHION ', 30000, 90000, 0, 'PCS'),
(114, 9, 114, 'KALUNG + GELANG BATU ', 150000, 300000, 0, 'PCS'),
(115, 9, 115, 'KALUNG +GELANG CRYSTAL ', 125000, 270000, 0, 'PCS'),
(116, 9, 116, 'KALUNG LOVE ', 10000, 30000, 0, 'PCS'),
(117, 9, 117, 'KALUNG DAYAK', 35000, 125000, 0, 'PCS'),
(118, 9, 118, 'KALUNG ANAK', 15000, 50000, 0, 'PCS'),
(119, 9, 119, 'KALUNG MANIK DAYAK', 15000, 60000, 0, 'PCS'),
(120, 9, 120, 'KALUNG + LIONTIN (XUPING)', 80000, 240000, 0, 'PCS'),
(121, 10, 121, 'MINYAK BUBUT', 20000, 60000, 0, 'PCS'),
(122, 10, 122, 'MINYAK SONGGANA', 20000, 60000, 0, 'PCS'),
(123, 10, 123, 'MINYAK DAYAK', 20000, 60000, 0, 'PCS'),
(124, 10, 124, 'MINYAK BELITUNG ', 20000, 60000, 0, 'PCS'),
(125, 10, 125, 'MINYAK SERAY', 20000, 60000, 0, 'PCS'),
(126, 10, 126, 'MINYAK URUT PALA', 10000, 30000, 0, 'PCS'),
(127, 10, 127, 'MINYAK BUAH ULIN', 20000, 60000, 0, 'PCS'),
(128, 10, 128, 'MINYAK BUBUT KECIL', 10000, 30000, 0, 'PCS'),
(129, 10, 129, 'MINYAK SERAY KECIL', 10000, 30000, 0, 'PCS'),
(130, 10, 130, 'MINYAK BULUS ', 10000, 30000, 0, 'PCS'),
(131, 10, 131, 'MINYAK DAYAK BESAR', 15000, 90000, 0, 'PCS'),
(132, 10, 132, 'MINYAK BAJAKAH', 12000, 60000, 0, 'PCS'),
(133, 10, 133, 'MINYAK BAWANG DAYAK', 12000, 60000, 0, 'PCS'),
(134, 10, 134, 'MINYAK GAHARU KECIL', 15000, 45000, 0, 'PCS'),
(135, 11, 135, 'BROS BATU ', 15000, 50000, 0, 'PCS'),
(136, 11, 136, 'BROS 1 + KOTAK', 25000, 75000, 0, 'PCS'),
(137, 11, 137, 'BROS 2', 25000, 50000, 0, 'PCS'),
(138, 11, 138, 'KONEKTOR MASKER TALI CRYSTAL', 13000, 25000, 0, 'PCS'),
(139, 11, 139, 'SHAL KAIN', 20000, 60000, 0, 'PCS'),
(140, 11, 140, 'PECI ROTAN', 20000, 60000, 0, 'PCS'),
(141, 11, 141, 'TOPI DAYAK TARING', 90000, 270000, 0, 'PCS'),
(142, 11, 142, 'KONEKTOR MASKER BATU/KERIKIL', 20000, 100000, 0, 'PCS'),
(143, 11, 143, 'KONEKTOR MASKER BATU PENDEK', 15000, 75000, 0, 'PCS'),
(144, 11, 144, 'KONEKTOR MASKER CRYSTAL', 13000, 50000, 0, 'PCS'),
(145, 11, 145, 'KONEKTOR MASKER CRYSTAL PENDEK', 11000, 50000, 0, 'PCS'),
(146, 11, 146, 'GANTUNGAN KUNCI BATU AJI', 2500, 12500, 0, 'PCS'),
(147, 11, 147, 'GANTUNGAN MOBIL MANIK', 15000, 50000, 0, 'PCS'),
(148, 11, 148, 'KONEKTOR MASKER MANIK DAYAK', 16000, 50000, 0, 'PCS'),
(149, 11, 149, 'KIPAS SASIRANGAN', 20000, 60000, 0, 'PCS'),
(150, 12, 150, 'TASBIH KECUBUNG 99', 65000, 130000, 0, 'PCS'),
(151, 12, 151, 'TASBIH CAT EYE 99', 20000, 60000, 0, 'PCS'),
(152, 12, 152, 'TASBIH KAYU', 40000, 120000, 0, 'PCS'),
(153, 12, 153, 'TASBIH BATU', 85000, 170000, 0, 'PCS'),
(154, 12, 154, 'TASBIH CRYSTAL', 25000, 80000, 0, 'PCS'),
(155, 12, 155, 'TASBIH BATU AJI', 20000, 60000, 0, 'PCS'),
(156, 12, 156, 'TASBIH TIGER EYE', 50000, 150000, 0, 'PCS'),
(157, 12, 157, 'TASBIH DIGITAL', 12000, 60000, 0, 'PCS'),
(158, 12, 158, 'TASBIH GAHARU 6ML 99', 22000, 75000, 0, 'PCS'),
(159, 12, 159, 'TASBIH KAYU CENDANA 99', 4000, 30000, 0, 'PCS'),
(160, 12, 160, 'TASBIH KAYU STECI SUPER 99', 12500, 60000, 0, 'PCS'),
(161, 12, 161, 'TASBIH KAYU STECI 99', 2250, 12500, 0, 'PCS'),
(162, 12, 162, 'TASBIH KECUBUNG 33', 45000, 90000, 0, 'PCS'),
(163, 12, 163, 'TASBIH CAT EYE 33', 5000, 30000, 0, 'PCS'),
(164, 12, 164, 'TASBIH GAHARU 8ML 99', 32000, 100000, 0, 'PCS');

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