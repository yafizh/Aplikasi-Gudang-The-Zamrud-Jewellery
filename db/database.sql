DROP DATABASE IF EXISTS `db_gudang`;
CREATE DATABASE `db_gudang`;
USE `db_gudang`;

CREATE TABLE `db_gudang`.`pengguna` (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    status VARCHAR(255),
    PRIMARY KEY (id)
);

CREATE TABLE `db_gudang`.`petugas` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pengguna INT NOT NULL,
    nik VARCHAR(255),
    nama VARCHAR(255),
    jabatan VARCHAR(255),
    nomor_telepon VARCHAR(255),
    tempat_lahir VARCHAR(255),
    tanggal_lahir DATE,
    jenis_kelamin VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_pengguna) REFERENCES pengguna (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`jenis_barang` (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    kode VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `db_gudang`.`barang` (
    id INT NOT NULL AUTO_INCREMENT,
    id_jenis_barang INT NOT NULL,
    nama VARCHAR(255),
    harga_toko INT,
    harga_label INT,
    stok_tersedia INT,
    stok_tidak_tersedia INT,
    satuan VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (id_jenis_barang) REFERENCES jenis_barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`pemasok` (
    id INT NOT NULL AUTO_INCREMENT,
    nama VARCHAR(255),
    nomor_telepon VARCHAR(255),
    email VARCHAR(255),
    alamat TEXT,
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
    id_barang INT NOT NULL,
    tanggal DATE,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_penyuplaian) REFERENCES penyuplaian (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);

CREATE TABLE `db_gudang`.`pameran` (
    id INT NOT NULL AUTO_INCREMENT,
    id_petugas INT NOT NULL,
    nama VARCHAR(255),
    tempat VARCHAR(255),
    tanggal_waktu_mulai DATETIME,
    tanggal_waktu_selesai DATETIME,
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

CREATE TABLE `db_gudang`.`barang_terjual` (
    id INT NOT NULL AUTO_INCREMENT,
    id_pameran INT NOT NULL,
    id_barang INT NOT NULL,
    jumlah INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_pameran) REFERENCES pameran (id) ON DELETE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang (id) ON DELETE CASCADE
);
