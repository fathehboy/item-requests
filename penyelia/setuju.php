<?php
require_once "cek_asmen.php";
include "../fungsi/koneksi.php";

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$tanggal = date('Y-m-d');

	$query1 = mysqli_query($koneksi, "UPDATE permintaan SET status=1 WHERE id_permintaan='$id' ");

	//$query2 = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan='$id'");

	//$row = mysqli_fetch_assoc($query2);

	//$query3 = mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, jumlah, tgl_keluar)
	//										VALUES ('$row[unit]', '$row[kode_brg]', '$row[jumlah]', '$tanggal' ) ");

	if ($query1) { 
	header("location:index.php?p=datapesanan");
        $chatid = "656180881";
	$text = "Silahkan cek Data Permintaan barang Pak";
	sendApiMsg($chatid, $text);
	} else {
		echo "ada yang salah" . mysqli_error($koneksi);
	}
}
?>
