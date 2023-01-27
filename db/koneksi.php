<?php

$mysqli = new mysqli("localhost", "root", "", "db_gudang");

// Check connection
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

function generateKodeBarang($number)
{
  if ($number < 10)
    return ("00" . $number);
  elseif ($number < 100)
    return ("0" . $number);
  elseif ($number < 1000)
    return $number;
}

const MONTH_IN_INDONESIA = [
  "Januari",
  "Februari",
  "Maret",
  "April",
  "Mei",
  "Juni",
  "July",
  "Agustus",
  "September",
  "Oktober",
  "November",
  "Desember"
];

const DAY_IN_INDONESIA = [
  "Minggu",
  "Senin",
  "Selasa",
  "Rabu",
  "Kamis",
  "Jumat",
  "Sabtu"
];

function indoensiaDateWithDay($date)
{
  $tanggal = explode('-', $date)[2];
  $bulan = explode('-', $date)[1];
  $tahun = explode('-', $date)[0];
  return DAY_IN_INDONESIA[Date("w", strtotime($date))] . ', ' . $tanggal . ' ' . MONTH_IN_INDONESIA[$bulan - 1] . ' ' . $tahun;
}
