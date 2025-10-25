<?php
require_once '../assets/php/class/User.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (isset($_SESSION['users'][$username])) {
        $user = $_SESSION['users'][$username];
        if ($user->verifyPassword($password)) {
            $_SESSION['user'] = $user;
            header('Location: ../public/index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Usuário ou senha incorretos.';
        header('Location: ../public/login.php');
    }

}
?>