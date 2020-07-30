<?php
require_once "cek_admin.php";
include "../fungsi/koneksi.php";

if (isset($_POST['update'])) {

	$kode_brg = $_POST['kode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$id_jenis = $_POST['id_jenis'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$satuan = $_POST['satuan'];
	$harga_item = $_POST['harga_item'];
	$stok = $_POST['jumlah'];



	$query = mysqli_query($koneksi, "UPDATE stokbarang SET nama_brg='$nama_brg', id_jenis='$id_jenis', tgl_masuk='$tgl_masuk', satuan='$satuan', harga_item='$harga_item', stok='$stok', sisa=stok-keluar WHERE kode_brg ='$kode_brg' ");
	if ($query) {
		header("location:index.php?p=material");
	} else {
		echo 'error' . mysqli_error($koneksi);
	}
}
?>