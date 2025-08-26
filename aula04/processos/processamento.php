<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nome'] = $_POST['nome'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['mensagem'] = $_POST['mensagem'] ?? '';

    // Redireciona para a página de exibição
    header('Location: ../exibir.php');
    exit;
} else {
    // Se acessarem diretamente, redireciona para o formulário
    header('Location: ../formulario.php');
    exit;
}
?>
