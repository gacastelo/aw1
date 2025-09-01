<?php 
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        $_SESSION['status'] = "Todos os campos devem ser preenchidos!";
        exit;
    }
    $email = $_POST['email'];
    $senhaDigitada = $_POST['senha'];


    $dados = json_decode(file_get_contents("../db/usuarios.json"), true);

    foreach ($dados as $usuario) {
        if ($usuario["email"] == $email) {
            if (password_verify($senhaDigitada, $usuario["senha"])) {
                // Senha correta
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $usuario['nome'];
                $_SESSION['logado'] = true;
                header('Location: ../formulario.php');
                exit;
            } else {
                $_SESSION['logado'] = false;
                $_SESSION['status'] = 'Senha incorreta';
                exit;
            }
        }
    }

    $_SESSION['status'] = "Email não encontrado!";
    exit;
} else {
    header('Location: ../login.php');
    exit;
}
?>