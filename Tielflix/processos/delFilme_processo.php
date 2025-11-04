<?php
require_once '../assets/php/class/User.php';
require_once '../assets/php/class/Filme.php';
if (!isset($_SESSION)) {
    session_start();
}
var_dump($_POST);
$filme_titulo = $_POST['filme_title'] ?? '';
$username = $_SESSION['user']->username;
$filme = $_SESSION['users'][$username]->getFilmebyTitle($filme_titulo);
$_SESSION['users'][$username]->delFilme($filme);
var_dump($_SESSION['users'][$username]);
header('Location: ../public/user.php'. '?user=' . $username);
?>