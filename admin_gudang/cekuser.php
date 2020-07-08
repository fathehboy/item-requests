<?php  

session_start();

if (!isset($_SESSION['login'])) {
	header("location:../index.php");
}

if ($_SESSION['level'] != "admin_gudang"){
	header("location:../index.php");
}


?>