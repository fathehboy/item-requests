<?php
session_start();
if ($_SESSION['login'] == 1 && $_SESSION['level'] != 'pen_sdm&umum') {
    header('Location:../' . $_SESSION['level']);
} else if ($_SESSION['login'] != 1) {
    echo 'Please login first';
    header('Location:../index.php');
}
?>