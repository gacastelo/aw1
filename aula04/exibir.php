<?php
session_start();
if (!$_SESSION['logado']) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dados Recebidos</title>
</head>
<body>
    <h1>Dados Recebidos</h1>

    <p><strong>Nome:</strong> <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Não informado'); ?></p>
    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? 'Não informado'); ?></p>
    <p><strong>Mensagem:</strong> <?php echo nl2br(htmlspecialchars($_SESSION['mensagem'] ?? 'Não informada')); ?></p>

    <a href="formulario.php">Voltar ao formulário</a>
</body>
</html>
