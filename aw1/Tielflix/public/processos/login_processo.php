<?php
require_once '../../src/User.php';
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
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Usuário ou senha incorretos.';
        header('Location: ../login.php');
    }

}
?>