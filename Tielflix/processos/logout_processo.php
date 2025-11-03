<?php 
if (!isset($_SESSION)) {
    session_start();
}
$_SESSION['user'] = null;
header('Location: ../public/login.php');
?>