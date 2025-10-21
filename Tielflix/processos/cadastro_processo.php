<?php
require_once '../assets/php/class/User.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'];

    $_SESSION['users'][$username] = new User($username, $email, $password);
    header('Location: ../public/login.php');
    exit();
}
?>