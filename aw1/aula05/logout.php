<?php
session_start();
$_SESSION['logado'] = null;
$_SESSION['nome'] = null;
$_SESSION['email'] = null;
$_SESSION['senha'] = null;
header('Location: login.php');
exit;
?>