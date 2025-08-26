<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = isset($usuarios['email']) && $usuarios['email']['senha'] === $_POST['senha'];
    if (!$ok) {
        header('Location: formulario.php');
        exit;
    }
    
    $_SESSION['nome'] = $_POST['nome'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['mensagem'] = $_POST['mensagem'] ?? '';
    $_SESSION['sigma'] = True;
    
    $email = $_POST['email'];


    // simulação banco
    $usuarios =[
        'usuario@user.com' => [
            'nome' => 'Usuário',
            'senha' => '123456'
        ]
        ];
    

    // Redireciona para a página de exibição
    header('Location: exibir.php');
    exit;
} else {
    // Se acessarem diretamente, redireciona para o formulário
    header('Location: formulario.php');
    exit;
}
?>
