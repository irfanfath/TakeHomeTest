<?php
// include database connection file
include_once("./config.php");
 
// Get id from URL to delete that user
$id = $_GET['id'];
 
// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM gudang_barang WHERE id=$id");
// $result2 = mysqli_query($koneksi, "DELETE FROM tambah_barang WHERE id=$id");
 
// After delete redirect to Home, so that latest user list will be displayed.
header("Location: data_barang.php");
?>
