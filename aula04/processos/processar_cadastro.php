<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
$dados = json_decode(file_get_contents('../db/usuarios.json'), true);

foreach ($dados as $usuario) {
    if ($usuario['email'] === $_POST['email']) {
        echo "Este e-mail já está cadastrado!";
        exit;
    }
}


if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['senha'])) {
        echo "Todos os campos devem ser preenchidos!";
        exit;
}



$novoUsuario = [
    'id' => count($dados) + 1,
    'nome' => $_POST['nome'],
    'email' => $_POST['email'],
    'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
];

$dados[] = $novoUsuario;

file_put_contents("../db/usuarios.json", json_encode($dados, JSON_PRETTY_PRINT));

header('Location: ../login.php');
exit;
}
?>