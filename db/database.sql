DROP DATABASE IF EXISTS `db_gudang`;
CREATE DATABASE `db_gudang`;
USE `db_gudang`;

CREATE TABLE `db_gudang`.`pengguna` (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    status ENUM('ADMIN', 'PETUGAS', 'PEGAWAI'),
    PRIMARY KEY (id)
);

CREATE TABLE `db_gudang`.`petugas` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pengguna INT NOT NULL,
    nik VARCHAR(16),
    nama VARCHAR(255),
    jabatan VARCHAR(255),
    nomor_telepon VARCHAR(20),
    tempat_lahir VARCHAR(255),
    tanggal_lahir DATE,
    jenis_kelamin VARCHAR(50),
    tanggal_terdaftar DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pengguna) REFERENCES pengguna (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`pegawai` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pengguna INT NOT NULL,
    nik VARCHAR(16),
    nama VARCHAR(255),
    jabatan VARCHAR(255),
    nomor_telepon VARCHAR(20),
    tempat_lahir VARCHAR(255),
    tanggal_lahir DATE,
    jenis_kelamin VARCHAR(50),
    tanggal_terdaftar DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pengguna) REFERENCES pengguna (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`jenis_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    kode VARCHAR(10) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `db_gudang`.`barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_jenis_barang INT NOT NULL,
    kode INT,
    nama VARCHAR(255),
    harga_toko INT,
    harga_label INT,
    stok INT,
    satuan VARCHAR(20),
    PRIMARY KEY (id),
    FOREIGN KEY (id_jenis_barang) REFERENCES jenis_barang (id) ON DELETE CASCADE
);


CREATE TABLE `db_gudang`.`toko` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pegawai INT NOT NULL,
    nama VARCHAR(255),
    alamat TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pegawai) REFERENCES pegawai (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`penjualan_toko` (
    id INT NOT NULL AUTO_INCREMENT,
    id_toko INT NOT NULL,
    tanggal DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_toko) REFERENCES toko (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`detail_penjualan_toko` (
    id INT NOT NULL AUTO_INCREMENT,
    id_penjualan_toko INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_penjualan_toko) REFERENCES penjualan_toko (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`distribusi_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_toko INT NOT NULL,
    id_petugas INT NOT NULL,
    tanggal DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_toko) REFERENCES toko (id) ON DELETE CASCADE,
    FOREIGN KEY (id_petugas) REFERENCES petugas (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`detail_distribusi_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_distribusi_barang INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_distribusi_barang) REFERENCES distribusi_barang (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`pemasok` (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255),
    nomor_telepon VARCHAR(20),
    email VARCHAR(50),
    alamat TEXT,
    tanggal_terdaftar DATE,
    PRIMARY KEY (id) 
);

CREATE TABLE `db_gudang`.`penyuplaian` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pemasok INT NOT NULL,
    id_petugas INT NOT NULL,
    tanggal DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pemasok) REFERENCES pemasok (id) ON DELETE CASCADE,
    FOREIGN KEY (id_petugas) REFERENCES petugas (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`detail_penyuplaian` (
    id INT NOT NULL AUTO_INCREMENT,
    id_penyuplaian INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_penyuplaian) REFERENCES penyuplaian (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`return_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_penyuplaian INT NOT NULL,
    tanggal DATE,
    PRIMARY KEY (id),
    FOREIGN KEY (id_penyuplaian) REFERENCES penyuplaian (id) ON DELETE CASCADE 
);

CREATE TABLE `db_gudang`.`detail_return_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_return_barang INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    alasan TEXT,
    bentuk_penggantian_barang VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_return_barang) REFERENCES return_barang (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`pameran` (
    id INT NOT NULL AUTO_INCREMENT,
    id_petugas INT NOT NULL,
    nama VARCHAR(255),
    tempat VARCHAR(255),
    tanggal_mulai DATE,
    tanggal_selesai DATE,
    penyelenggara VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_petugas) REFERENCES petugas (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`detail_pameran` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pameran INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pameran) REFERENCES pameran (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`penjualan_pameran` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pameran INT NOT NULL,
    nama VARCHAR(255),
    domisili VARCHAR(255),
    nomor_telepon VARCHAR(20),
    tanggal DATE,
    jenis_pembayaran VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_pameran) REFERENCES pameran (id) ON DELETE CASCADE 
);


CREATE TABLE `db_gudang`.`detail_penjualan_pameran` (
    id INT NOT NULL AUTO_INCREMENT,
    id_penjualan_pameran INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_penjualan_pameran) REFERENCES penjualan_pameran (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

DELIMITER $$
CREATE TRIGGER after_insert_detail_distribusi_barang 
    AFTER INSERT 
    ON detail_distribusi_barang 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok-NEW.jumlah) 
    WHERE 
        id=NEW.id_barang;
END$$

CREATE TRIGGER after_delete_detail_distribusi_barang 
    AFTER DELETE 
    ON detail_distribusi_barang 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok+OLD.jumlah) 
    WHERE 
        id=OLD.id_barang;
END$$

CREATE TRIGGER after_insert_detail_penyuplaian 
    AFTER INSERT 
    ON detail_penyuplaian 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok+NEW.jumlah) 
    WHERE 
        id=NEW.id_barang;
END$$

CREATE TRIGGER after_delete_detail_penyuplaian 
    AFTER DELETE 
    ON detail_penyuplaian 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok-OLD.jumlah) 
    WHERE 
        id=OLD.id_barang;
END$$

CREATE TRIGGER after_insert_detail_penjualan_pameran 
    AFTER INSERT 
    ON detail_penjualan_pameran 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok-NEW.jumlah) 
    WHERE 
        id=NEW.id_barang;
END$$

CREATE TRIGGER after_delete_detail_penjualan_pameran 
    AFTER DELETE 
    ON detail_penjualan_pameran 
    FOR EACH ROW 
BEGIN 
    UPDATE barang SET 
        stok=(stok+OLD.jumlah) 
    WHERE 
        id=OLD.id_barang;
END$$

CREATE PROCEDURE after_insert_detail_return_barang(id_barang INT, new_jumlah INT)
BEGIN 
    UPDATE barang SET 
        stok=(stok-new_jumlah) 
    WHERE 
        id=id_barang;
END$$

CREATE PROCEDURE after_delete_detail_return_barang(id_barang INT, old_jumlah INT)
BEGIN 
    UPDATE barang SET 
        stok=(stok+old_jumlah) 
    WHERE 
        id=id_barang;
END$$

DELIMITER ;