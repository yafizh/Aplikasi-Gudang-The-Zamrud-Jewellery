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

function indonesiaDate($date)
{
  $tanggal = explode('-', $date)[2];
  $bulan = explode('-', $date)[1];
  $tahun = explode('-', $date)[0];
  return $tanggal . ' ' . MONTH_IN_INDONESIA[$bulan - 1] . ' ' . $tahun;
}

function compareDate($first_date, $second_date = null)
{
  $date1 = new DateTime($first_date);
  $date2 = new DateTime(($second_date ?? Date("Y-m-d")));
  $interval = $date1->diff($date2);

  $umur = "";

  if ($interval->y)
    $umur = $interval->y . " Tahun";
  if ($interval->m)
    $umur = " " . $interval->m . " Bulan";
  if ($interval->d)
    $umur = " " . $interval->d . " Hari ";

  if (!($interval->d || $interval->m || $interval->y))
    $umur = "1 Hari";

  return $umur;
}
