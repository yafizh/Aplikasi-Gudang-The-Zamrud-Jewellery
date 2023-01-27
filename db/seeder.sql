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