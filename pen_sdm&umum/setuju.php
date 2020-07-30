<?php
require_once "cek_asmen.php";
include "../fungsi/koneksi.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$tanggal = date('Y-m-d');

	

	$query2 = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan='$id'");

	$row = mysqli_fetch_assoc($query2);

	$query3 = mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
											VALUES ('$row[unit]', '$row[kode_brg]', '$row[jumlah]', '$tanggal' ) ");

	$query1 = mysqli_query($koneksi, "UPDATE permintaan SET status=2 WHERE id_permintaan='$id' ");

	if ($query3) { 
		header("location:index.php?p=datapesanan");
	} else {
		echo "ada yang salah" . mysqli_error($koneksi);
	}
}
?>