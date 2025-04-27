<?php
include 'koneksi.php';

$nama = $_POST['nama_tugas'];
$prioritas = $_POST['prioritas'];
$tanggal = $_POST['tanggal'];

if (!empty($nama) && !empty($prioritas) && !empty($tanggal)) {
    $conn->query("INSERT INTO tasks (nama_tugas, status, prioritas, tanggal) VALUES ('$nama', 'belum', '$prioritas', '$tanggal')");
}

header("Location: index.php");
?>
