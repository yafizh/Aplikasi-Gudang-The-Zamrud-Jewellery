INSERT INTO `db_gudang`.`pengguna` (
    id,
    username,
    password,
    status
) VALUES 
(1, 'admin', 'admin', 'ADMIN'),
(2, '18631863', '18631863', 'ADMIN');

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
(1, 2, '18631863', 'Nama', 'Jabatan', 'Nomor Telepon', 'Laki - Laki', '2000-01-01', 'Martapura', CURRENT_DATE());

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

INSERT INTO `db_gudang`.`pemasok` (
    id,
    nama,
    nomor_telepon,
    email,
    alamat,
    tanggal_terdaftar  
) VALUES 
(1, 'A', '0', 'email@example.com', 'jalan', CURRENT_DATE());