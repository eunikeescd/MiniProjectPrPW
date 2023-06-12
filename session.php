<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login_kalender.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login_kalender.php');
}

?>
