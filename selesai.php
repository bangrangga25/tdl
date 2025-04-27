<?php
include 'koneksi.php';

$id = $_GET['id'];
$conn->query("UPDATE tasks SET status='selesai' WHERE id=$id");

header("Location: index.php");
?>
