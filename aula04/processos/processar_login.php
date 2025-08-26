<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);


$dados = json_decode( file_get_contents("../db/usuarios.json"), true);



foreach ($dados as $usuario) {
    if ($usuario["email"] == $email && $usuario["senha"] == $senha) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['valido'] = true;
        header('Location: formulario.php');
        exit;
    }
}
}
?>