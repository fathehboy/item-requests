<?php

function levelcheck()
{
	if (isset($_SESSION['login'])) {
		header('location:' . $_SESSION['level'] . '/index.php');
	} else {
		header("location:index.php");
	}
}