<?php
session_start();
if (isset($_SESSION['login']) == 0) {
	header('Location:' . $_SESSION['level'] . '/index.php');
}
?>