<?php
session_start();
if (isset($_SESSION['login']) == 1) {
	header('Location:' . $_SESSION['level'] . '/index.php');
}
?>